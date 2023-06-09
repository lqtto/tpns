<?php

namespace tencent\tpns;

class AcceptTimeRange {
    public $start;      //AcceptTime
    public $end;        //AcceptTime

    public function filter () {
        if (isset($this->start) && $this->start != null) {
            if (method_exists($this->start, 'filter')) {
                $this->start->filter();
            }
        } else {
            unset($this->start);
        }

        if (isset($this->end) && $this->end != null) {
            if (method_exists($this->end, 'filter')) {
                $this->end->filter();
            }
        } else {
            unset($this->end);
        }
    }
}