<?php

class My_Anal_Helper_Data extends Mage_Core_Helper_Abstract {
    
   
   
    public function __construct() {
      //  $this->_analPackages=array('google','clickTale');
    }
    
   
    
    private function _getActiveApis(){
   
      $potentialMatches = array('google','clickTale');
             $matches = array();
       foreach ($potentialMatches as $value) {
         $configString = 'my_anal/my_anal/'.$value.'Active';
         $matched = Mage::getStoreConfig($configString);
         if ($matched){
             $matches[] = $value;
         }
       }
           return $matches;
   }
    
    public function getActiveHelpers(){
        $result = array();
       $analApis = $this->_getActiveApis();
       
       foreach( $analApis as $apiString) {
        $result[] = Mage::helper('myanal/'.$apiString);
       }
       return $result;
    }
    
    
    
}