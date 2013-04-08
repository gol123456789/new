<?php

class My_Mod_Model_Resource_Routine_Exercise extends Mage_Core_Model_Resource_Db_Abstract {
    
    public function _construct() {
        $this->_init('mymod/routine_exercise','id');
    }
}