<?php

namespace tencent\tpns;

class Request {
    public $audience_type = "";
    public $platform      = "";
    public $message;                // Message
    public $message_type  = "";

    public $tag_rules;              // array of TagRule
    public $token_list;             // array of string
    public $account_list;           // array of string

    public $environment           = "";
    public $upload_id             = 0;
    public $expire_time           = 259200;
    public $send_time             = "";
    public $multi_pkg             = false;
    public $plan_id               = "";
    public $account_push_type     = 0;
    public $account_type          = 0;
    public $collapse_id           = 0;
    public $push_speed            = 0;
    public $tpns_online_push_type = 0;
    public $ignore_invalid_token  = 0;
    public $force_collapse        = false;

    public $channel_rules;         //array of ChannelRule
    public $loop_param;            //LoopParam

    public function filter() {
        if (isset($this->message) && $this->message != null) {
            if (method_exists($this->message, 'filter')){
                $this->message->filter();
            }
        } else {
            unset($this->message);
        }

        if (isset($this->tag_rules) && $this->tag_rules == null) {
            unset($this->tag_rules);
        }

        if (isset($this->token_list) && $this->token_list == null) {
            unset($this->token_list);
        }

        if (isset($this->account_list) && $this->account_list == null) {
            unset($this->account_list);
        }

        if (isset($this->channel_rules) && $this->channel_rules == null) {
            unset($this->channel_rules);
        }

        if (isset($this->loop_param) && $this->loop_param != null) {
            if (method_exists($this->loop_param, 'filter')) {
                $this->loop_param->filter();
            }
        } else {
            unset($this->loop_param);
        }
    }

    public function Validate() {
        if (empty($this->audience_type)) {
            throw new \Exception("audience_type is not set");
        }

        if ($this->audience_type != AUDIENCE_ALL &&
            $this->audience_type != AUDIENCE_TAG &&
            $this->audience_type != AUDIENCE_TOKEN &&
            $this->audience_type != AUDIENCE_TOKEN_LIST &&
            $this->audience_type != AUDIENCE_ACCOUNT &&
            $this->audience_type != AUDIENCE_ACCOUNT_LIST &&
            $this->audience_type != AUDIENCE_ACCOUNT_PACKAGE &&
            $this->audience_type != AUDIENCE_TOKEN_PACKAGE) {
            throw new \Exception ("invalid audience_type: ".$this->audience_type);
        }

        if ($this->audience_type == AUDIENCE_TOKEN || $this->audience_type == AUDIENCE_TOKEN_LIST) {
            if (empty($this->token_list)) {
                throw new \Exception ("empty token_list");
            }
            if (!is_array($this->token_list)) {
                throw new \Exception ("token_list need to be array");
            }
        }

        if ($this->audience_type == AUDIENCE_ACCOUNT || $this->audience_type == AUDIENCE_ACCOUNT_LIST) {
            if (empty($this->account_list)) {
                throw new \Exception ("empty account_list");
            }
            if (!is_array($this->account_list)) {
                throw new \Exception ("account_list need to be array");
            }
        }

        if ($this->audience_type == AUDIENCE_TAG) {
            if (empty($this->tag_rules)) {
                throw new \Exception ("empty tag_rules");
            }
            if (!is_array($this->tag_rules)) {
                throw new \Exception ("tag_rules need to be array");
            }
        }

        //if (empty($this->platform)) {
        //    throw new \Exception("empty platform");
        //}

        //if ($this->platform != PLATFORM_ANDROID && $this->platform != PLATFORM_IOS) {
        //    throw new \Exception("invalid platform: " . $this->platform);
        //}

        if ($this->message == null) {
            throw new \Exception("empty message");
        }

        if (empty($this->message_type)) {
            throw new \Exception("empty message_type");
        }

        if ($this->message_type != MESSAGE_NOTIFY && $this->message_type != MESSAGE_MESSAGE) {
            throw new \Exception("invalid message_type: " . $this->message_type);
        }

        //if ($this->platform == PLATFORM_IOS) {
        if ($this->message->ios != null) {
            if (empty($this->environment)) {
                throw new \Exception("empty environment");
            }
            if ($this->environment != ENVIRONMENT_PROD && $this->environment != ENVIRONMENT_DEV) {
                throw new \Exception("invalid environment: " . $this->environment);
            }
        }

        if (isset($this->channel_rules)) {
            if (!is_array($this->channel_rules)) {
                throw new \Exception ("channel_rules need to be array");
            }
        }
    }

    public function Marshal() {
        $this->filter();

        //if ($this->platform == PLATFORM_ANDROID) {
        //    unset($this->message->ios);
        //}

        //if ($this->platform == PLATFORM_IOS) {
        //    unset($this->message->android);

        if (isset($this->message) && $this->message != null) {
            if (isset($this->message->ios) && $this->message->ios != null) {
                if (isset($this->message->ios->aps) && $this->message->ios->aps != null) {
                    $aps = $this->message->ios->aps;
                    if (isset($aps->content_available) && $aps->content_available != null  &&
                        isset($aps->mutable_content) && $aps->mutable_content != null) {
                        $this->message->ios->aps = array(
                            "alert"      => $aps->alert,
                            "badge_type" => $aps->badge_type,
                            "category" => $aps->category,
                            "content-available" => $aps->content_available,
                            "sound" => $aps->sound,
                            "mutable-content" => $aps->mutable_content
                        );
                    }
                }
            }
        }
        //}

        $data = json_encode($this);
        return $data;
    }

}