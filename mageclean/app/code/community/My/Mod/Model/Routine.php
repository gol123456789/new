<?php

class My_Mod_Model_Routine extends Mage_Core_Model_Abstract {
    
    private $_exercisesCollection;
    public function _construct() {
        $this->_init("mymod/routine");
    }
    public function loadExercisesWithDetail(){
       //  
    }
    public function toJson(array $arrAttributes = array()) {
        parent::toJson($arrAttributes);
    }
    
  
}