<?php

class My_Mod_Model_Resource_Exercise_Requirement extends Mage_Core_Model_Resource_Db_Abstract {
    
    public function _construct() {
        $this->_init('mymod/exercise_requirement','id');
    }
}
