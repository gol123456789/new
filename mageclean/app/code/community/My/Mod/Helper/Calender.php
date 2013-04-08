<?php

class My_Mod_Helper_Calender extends Mage_Core_Helper_Abstract {

    public $collection = null;
    public $collection = null;
    public $_config = null;

    public function setCollection($collection) {
        $this->_collection = $collection;
    }

    // echo html
    // 
    public function render($options) {

        foreach ($this->_collection as $eventModel) {

            $this->startEventWindow();
            if ($eventModel->getDate() == $currentDate) {
                $this->wrapModel($eventModel);
            }
            $this->finishEventWindow();
        }
    }

    private function wrapModel($eventModel) {
        $this->getConfig()->getClassNames();
    }

    public function setConfig($object) {
        $this->_config = $object;
    }

    public function daysInMonth($month) {
        $start = '1/18/2013';
        $end = '2/17/2013';

        $range = new DatePeriod(
                        DateTime::createFromFormat('m/d/Y', $start),
                        new DateInterval('P1D'),
                        DateTime::createFromFormat('m/d/Y', $end));

        $filler = array();

        foreach ($range as $date) {
            $filler[] = array (
            'day' => $date->format ('m/d/Y'),
            'execution' => 0 );
        };

        $array += $filler;
    }

}