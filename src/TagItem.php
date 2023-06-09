<?php

namespace tencent\tpns;

class TagItem {
    public $tags;          //array of string
    public $is_not         = false;
    public $tags_operator  = "";
    public $items_operator = "";
    public $tag_type       = "";

    public function filter () {
        if (isset($this->tags) && $this->tags == null) {
            unset($this->tags);
        }
    }
}