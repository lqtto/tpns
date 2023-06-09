<?php

namespace tencent\tpns;

class Tpns{

    const GUANGZHOU = "api.tpns.tencent.com";
    const SINGAPORE = "api.tpns.sgp.tencent.com";
    const HONGKONG  = "api.tpns.hk.tencent.com";
    const SHANGHAI  = "api.tpns.sh.tencent.com";

    //audience type
    const AUDIENCE_ALL               = "all";
    const AUDIENCE_TAG               = "tag";
    const AUDIENCE_TOKEN             = "token";
    const AUDIENCE_TOKEN_LIST        = "token_list";
    const AUDIENCE_ACCOUNT           = "account";
    const AUDIENCE_ACCOUNT_LIST      = "account_list";
    const AUDIENCE_ACCOUNT_PACKAGE   = "package_account_push";
    const AUDIENCE_TOKEN_PACKAGE     = "package_token_push";

    // tag operation type
    const TAG_OPERATOR_AND = "AND";
    const TAG_OPERATOR_OR  = "OR";

    //deprecated
    // platform type
    const PLATFORM_ANDROID  = "android";
    const PLATFORM_IOS      = "ios";

    // message type
    const MESSAGE_NOTIFY  = "notify";
    const MESSAGE_MESSAGE = "message";

    // environment type
    const ENVIRONMENT_PROD = "product";
    const ENVIRONMENT_DEV  = "dev";


    // set audience type: AUDIENCE_ALL, AUDIENCE_TAG, AUDIENCE_TOKEN, AUDIENCE_TOKEN_LIST, AUDIENCE_ACCOUNT, AUDIENCE_ACCOUNT_LIST, AUDIENCE_ACCOUNT_PACKAGE, AUDIENCE_TOKEN_PACKAGE
    function WithAudienceType($type) {
        return function($r) use ($type) {
            $r->audience_type = $type;
        };
    }

    //deprecated
    // set platform: PLATFORM_ANDROID, PLATFORM_IOS
    function WithPlatform($platform) {
        return function($r) use ($platform) {
            $r->platform = $platform;
        };
    }

    //set message, type: Message
    function WithMessage($message) {
        return function($r) use ($message) {
            $r->message = $message;
        };
    }

    //set message title, type: string
    function WithTitle($title) {
        return function($r) use ($title) {
            if ($r->message == null) {
                $r->message = new Message;
            }
            $r->message->title = $title;
        };
    }

    //set message content, type: string
    function WithContent($content) {
        return function($r) use ($content) {
            if ($r->message == null) {
                $r->message = new Message;
            }
            $r->message->content = $content;
        };
    }

    //set message accept_time, type: array of AcceptTimeRange
    function WithAcceptTime($acceptTime) {
        return function($r) use ($acceptTime) {
            if ($r->message == null) {
                $r->message = new Message;
            }
            $r->message->accept_time = $acceptTime;
        };
    }

    //set message thread_id, type: string
    function WithThreadId($threadId) {
        return function($r) use ($threadId) {
            if ($r->message == null) {
                $r->message = new Message;
            }
            $r->message->thread_id = $threadId;
        };
    }

    //set message thread_sumtext, type: string
    function WithThreadSumText($threadSumText) {
        return function($r) use ($threadSumText) {
            if ($r->message == null) {
                $r->message = new Message;
            }
            $r->message->thread_sumtext = $threadSumText;
        };
    }

    //set message xg_media_resources, type string
    function WithXGMediaResources($xgMediaResources) {
        return function($r) use ($xgMediaResources) {
            if ($r->message == null) {
                $r->message = new Message;
            }
            $r->message->xg_media_resources = $xgMediaResources;
        };
    }

    //set message xg_media_audio_resources, type string
    function WithXGMediaAudioResources($xgMediaAudioResources) {
        return function($r) use ($xgMediaAudioResources) {
            if ($r->message == null) {
                $r->message = new Message;
            }
            $r->message->xg_media_audio_resources = $xgMediaAudioResources;
        };
    }

    //set message android, type AndroidMessage
    function WithAndroidMessage($android) {
        return function($r) use ($android) {
            if ($r->message == null) {
                $r->message = new Message;
            }
            $r->message->android = $android;
        };
    }

    //set message ios, type iOSMessage
    function WithIOSMessage($ios) {
        return function($r) use ($ios) {
            if ($r->message == null) {
                $r->message = new Message;
            }
            $r->message->ios = $ios;
        };
    }

    //set message_type, 'MESSAGE_NOTIFY' or 'MESSAGE_MESSAGE'
    function WithMessageType($type) {
        return function($r) use ($type) {
            $r->message_type = $type;
        };
    }

    //set tag_rules, type: array of TagRule
    function WithTagRules($tagRules) {
        return function($r) use ($tagRules) {
            $r->tag_rules = $tagRules;
        };
    }

    //set token_list, type: array of string
    function WithTokenList($tokenList) {
        return function($r) use ($tokenList) {
            $r->token_list = $tokenList;
        };
    }

    //set account_list, type: array of string
    function WithAccountList($accountList) {
        return function($r) use ($accountList) {
            $r->account_list = $accountList;
        };
    }

    //set environment, only for iOS, 'ENVIRONMENT_PROD' or 'ENVIRONMENT_DEV'
    function WithEnvironment($env) {
        return function($r) use ($env) {
            $r->environment = $env;
        };
    }

    //set upload_id, type: int
    function WithUploadId($uploadId) {
        return function($r) use ($uploadId) {
            $r->upload_id = $uploadId;
        };
    }

    //set expire_time, type: int
    function WithExpireTime($expireTime) {
        return function($r) use ($expireTime) {
            $r->expire_time = $expireTime;
        };
    }

    //set send_time, type: string
    function WithSendTime($sendtime) {
        return function($r) use ($sendtime) {
            $r->send_time = $sendtime;
        };
    }

    //set multi_pkg, type: boolean
    function WithMultiPkg($multiPkg) {
        return function($r) use ($multiPkg) {
            $r->multi_pkg = $multiPkg;
        };
    }

    //set plan_id, type: string
    function WithPlanId($planId) {
        return function($r) use ($planId) {
            $r->plan_id = $planId;
        };
    }

    //set account_push_type, type: int
    function WithAccountPushType($type) {
        return function($r) use ($type) {
            $r->account_push_type = $type;
        };
    }

    //set account_type, type: int
    function WithAccountType($type) {
        return function($r) use ($type) {
            $r->account_type = $type;
        };
    }

    //set collapse_id, type: int
    function WithCollapseId($collapseId) {
        return function($r) use ($collapseId) {
            $r->collapse_id = $collapseId;
        };
    }

    //set push_speed, type: int
    function WithPushSpeed($speed) {
        return function($r) use ($speed) {
            $r->push_speed = $speed;
        };
    }

    //set tpns_online_push_type, type int
    function WithTpnsOnlinePushType($type) {
        return function($r) use ($type) {
            $r->tpns_online_push_type = $type;
        };
    }

    //set ignore_invalid_token, type: bool
    function WithIgnoreInvalidToken($type) {
        return function($r) use ($type) {
            $r->ignore_invalid_token = $type ? 1 : 0;
        };
    }

    //set force_collapse, type: bool
    function WithForceCollapse($force) {
        return function($r) use ($force) {
            $r->force_collapse = $force;
        };
    }

    //set channel_rules, type: array of ChannelRule
    function WithChannelRules($channelRules) {
        return function($r) use ($channelRules) {
            $r->channel_rules = $channelRules;
        };
    }

    //set loop_param, type: LoopParam
    function WithLoopParam($param) {
        return function($r) use ($param) {
            $r->loop_param = $param;
        };
    }

    //@param: WithXXX
    //php<5.6 not support ...$args
    function NewRequest() {
        $r= new Request;
        $num = func_num_args();
        $args = func_get_args();
        for ($i = 0; $i < $num; $i++) {
            $args[$i]($r);
        }

        return $r;
    }

}