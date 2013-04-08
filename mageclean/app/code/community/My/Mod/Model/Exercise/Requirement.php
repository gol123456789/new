<?php

class My_Mod_Model_Exercise_Requirement extends Mage_Core_Model_Abstract {
      public function _construct() {
        $this->_init("mymod/exercise_requirement");
    }
    public function getByExerciseid($id) {
       return $this->getCollection()->addFieldToFilter('exercise_id', $id);
    }
}