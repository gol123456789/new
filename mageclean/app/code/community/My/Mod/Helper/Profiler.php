<?php

class My_Mod_Helper_Profiler extends My_Mod_Helper_Data {
    
   
    
    public function log($result, $adapter) {
       if ($adapter instanceof Zend_Db_Adapter_Abstract){
        $profile = count($adapter->getProfiler()->getQueryProfiles());
       } else {
           $profile = false;
       }
        if($profile) {
            $safeKey = $profile -1;
            $this->setResult($result, $safeKey);
            $this->setStack($safeKey);
        } else {
             $safeKey = '';
           //  $result = array();
            $this->setStack( $safeKey);
             $this->setResult($result, $safeKey);
        }
        
    }
    
   
   
}
    
