<?php

class My_Mod_Helper_Data extends Mage_Core_Helper_Abstract {
    
    protected $_result = array();
    protected $_stack = array();
    
    public static function register($name = "Profiler"){
        $lowerName = strtolower($name);
        $registryKey = '_helper/mymod/';
        $registryKey .= $lowerName;
        if (!Mage::registry($registryKey)) {
            $helperClass = 'My_Mod_Helper_'.$name;
            Mage::register($registryKey, new $helperClass);
        }
        return Mage::registry($registryKey);
    }
    
    public function setResult($result=null, $safeKey=null) {
        
        
        if(is_int($safeKey)) {
        $this->_result[$safeKey] = $result;
        } else {
          $this->_result[] = $result;  
        }
   }
    
    public function setStack($safeKey = null) {
        try {
            throw new Exception;
        }
         catch (Exception $e){
            if(is_int($safeKey)) {
                
            $this->_stack[$safeKey] = $e->getTrace();
              } else {
                 
                $this->_stack[] = $e->getTrace(); 
            }
         }
    }
    
    public function getStack( $arrPos){
        if ($arrPos===false){
            return $this->_stack;
        }
     if (array_key_exists($arrPos, $this->_stack)){
        return $this->_stack[$arrPos];
      }
        return array();
    }
    public function getResult( $arrPos=null){
        if($arrPos===false||null ){
            return $this->_result;
        }
        if (array_key_exists($arrPos, $this->_stack)){
          return $this->_result[$arrPos];
        }
        return array();
    }
    
}