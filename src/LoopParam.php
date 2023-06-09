<?php

namespace tencent\tpns;

class LoopParam {
    public $startDate  = "";
    public $endDate    = "";
    public $loopType   = 0;
    public $loopDayIndexs;  //array of uint32
    public $DayTimes;       //array of string

    public function filter() {
        if (isset($this->loopDayIndexs) && $this->loopDayIndexs == null) {
            unset($this->loopDayIndexs);
        }

        if (isset($this->DayTimes) && $this->DayTimes == null) {
            unset($this->DayTimes);
        }
    }
};