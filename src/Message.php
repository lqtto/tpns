<?php

namespace tencent\tpns;

class Message {
    public $title                    = "";
    public $content                  = "";
    public $accept_time;             //array of AcceptTimeRange
    public $thread_id                = "";
    public $thread_sumtext           = "";
    public $xg_media_resources       = "";
    public $xg_media_audio_resources = "";
    public $android;                 //AndroidMessage
    public $ios;                     //iOSMessage

    public function filter() {
        if (isset($this->accept_time) && $this->accept_time == null) {
            unset($this->accept_time);
        }

        if (isset($this->android) && $this->android != null) {
            if (method_exists($this->android, 'filter')){
                $this->android->filter();
            }
        } else {
            unset($this->android);
        }

        if (isset($this->ios) && $this->ios != null) {
            if (method_exists($this->ios, 'filter')) {
                $this->ios->filter();
            }
        } else {
            unset($this->ios);
        }
    }
}