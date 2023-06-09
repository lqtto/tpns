<?php

namespace tencent\tpns;

class iOSMessage {
    public $aps;                 //Aps
    public $custom = "";

    public function filter () {
        if (isset($this->aps) && $this->aps != null) {
            if (method_exists($this->aps, 'filter')) {
                $this->aps->filter();
            }
        } else {
            unset($this->aps);
        }
    }
}