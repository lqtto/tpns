<?php

namespace tencent\tpns;

class Aps {
    public $alert;
    public $badge_type          = 0;
    public $category            = "";
    public $content_available   = 0;    //json to content-available
    public $sound               = "";
    public $mutable_content     = 1;    //json to mutable-content

    public function filter() {
        if (isset($this->alert) && $this->alert == null) {
            unset($this->alert);
        }
    }
}