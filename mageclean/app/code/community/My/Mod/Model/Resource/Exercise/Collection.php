<?php

class My_Mod_Model_Resource_Exercise_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract {
    
    public function _construct() {
        $this->_init('mymod/exercise');
       
    }
    
}
