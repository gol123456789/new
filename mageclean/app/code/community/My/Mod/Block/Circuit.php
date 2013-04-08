<?php

class My_Mod_Block_Circuit extends Mage_Core_Block_Template {
    public function getid() {
        return Mage::registry('routine_id');
    }
    public function getRoutineModel(){
        return Mage::registry('routine');
    }

    public function getVidsArr() {
        $playlistId = $this->getId();
        $model = Mage::getModel('mymod/routine_exercise');
        $collection = $model->getCollection()->addFieldToFilter('id', $playlistId)->setOrder('id', 'ASC');
        $string = $collection->getSelect()->__toString();
        $arrr = array();
        foreach ($collection as $value) {
          //  var_dump($value);
            array_push($arrr, $value->getData());
        }
        return $arrr;
    }
    public function getJsonRoutine() {
        $routineVids = $this->getVidsArr();
        $routineModel = $this->getRoutineModel();
        $routineModel->setExercises($routineVids);
        $str = $routineModel->toJson();
        return $str;
    }

}