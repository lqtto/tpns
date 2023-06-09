<?php

namespace tencent\tpns;

class AndroidMessage {
    public $n_ch_id         = "";
    public $n_ch_name       = "";
    public $xm_ch_id        = "";
    public $hw_ch_id        = "";
    public $oppo_ch_id      = "";
    public $vivo_ch_id      = "";
    public $builder_id      = 0;
    public $badge_type      = -1;
    public $ring            = 1;
    public $ring_raw        = "";
    public $vibrate         = 1;
    public $lights          = 1;
    public $clearable       = 1;
    public $icon_type       = 0;
    public $icon_res        = "";
    public $style_id        = 0;
    public $small_icon      = "";
    public $action;                     //AndroidAction
    public $custom_content  = "";
    public $show_type       = 2;
    public $icon_color      = 0;

    public function filter() {
        if (isset($this->action) && $this->action != null) {
            if (method_exists($this->action, 'filter')) {
                $this->action->filter();
            }
        } else {
            unset($this->action);
        }
    }
}