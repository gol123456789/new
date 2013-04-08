<?php

class My_Mod_Model_Observer extends Varien_Object {
    
    public function prepareClassInfo($event){
        $response = $event->getResponse();
        $autoloader = Varien_Autoload::instance();
        $arr = $autoloader->getClassArr();
        $this->setData($arr);
       $helper = Mage::helper('mymod/includes');
       $helper->format($this, $response);
     //  $this->toString();
       
        return;
       // 
    }
    public function toString($format = '') {
        $data = $this->getData();
        $newData= array();
        foreach ($data as $section => $anArr) {
            foreach ($anArr as $value) {
               $newData[] = $value.'\n'; 
            }
          //  $newData[$key] = $value.'\n';
        }
        $this->setData($newData);
        $string = parent::toString();
        $finalString = '<div class="class">'.$string.'</div>';
        return $finalString;
    }
}