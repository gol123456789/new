<?php

class My_Mod_Model_Resource_Bla_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract {
    
    public function _construct() {
        $this->_init('mymod/bla');
       
    }
    
    public function joinStore() {
       $this->getSelect()->join(
               array('store_table' => 'core_store'),
               'store_table.store_id = main_table.fuck',
             array('name' => 'name')
           );
        $this->getSelect()->distinct();
        return $this;
        
    }

    public function addStoreFilter() {
        $this->getSelect()
                ->where('main_table.fuck=?', Mage::app()->getStore()->getId());
        return $this;
    }
    
    public function joinProducts() {
        $this->getSelect()
             ->join(
                array('int_values' => 'catalog_product_entity_int'),
                'store_table.store_id = main_table.fuck',
                array('value' => 'value')
            );
        return $this;
    }
}