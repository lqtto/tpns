<?php

namespace tencent\tpns;

class TagRule {
    public $tag_items;   //array of TagItem
    public $is_not       = false;
    public $operator     = "";

    public function filter () {
        if (isset($this->tag_items) && $this->tag_items == null) {
            unset($this->tag_items);
        }
    }
}