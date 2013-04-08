<?php

class My_Anal_Block_Widget_Abstract
extends Mage_Core_Block_Template 
implements Mage_Widget_Block_Interface {
    
    protected $_activeHelpers = array();
    protected $_dataHelper;

    public function getClassArr() {
       $classNameString = $this->getClassName();
       $classNameArr = explode(' ', $classNameString);
       return $classNameArr;
    }
    
    public function getJsonClassArr() {
        $classArr =$this->getClassArr();
       return Mage::helper('core')->jsonEncode($classArr);
    }


    public function formatClassArr(){
       $arr = $this->getClassArr();      
       $formattedArr = array();       
       foreach ($arr as $subject) {           
       $formattedArr[] =  "'.".$subject."'";    
       }    
    return $formattedArr;
    }
    
    public function formatArgString () {
        $formattedArr = $this->formatClassArr();      
        $argString = implode(',', $formattedArr); 
        return $argString;
    }
    public function dataHelper() {
       return Mage::helper('myanal');
    }
    public function setHelpers(){
        $this->_dataHelper = $this->dataHelper();
        $this->_activeHelpers = $this->_dataHelper->getActiveHelpers();
    }
    
    public function renderStacks(){
         $activeHelpers = $this->_activeHelpers;
         $stringStacksArr = array();
         foreach ($activeHelpers as $renderer) {
           $stringStacksArr[] = $renderer->renderStack();
        }
        return implode('', $stringStacksArr);
        
    }
    public function renderEvents(){
        $activeHelpers = $this->_activeHelpers;
        $eventArrData = $this-> getNameLabelArr();
        $stringEventsArr = array();
        foreach ($activeHelpers as $renderer) {
           $stringEventsArr[] = $renderer->renderEvent($eventArrData);
        }
        return $stringEventsArr;
   }
   public function getNameLabelArr(){
       $arr = array();
       $arr['event'] = $this->getEventName();
       $arr['label'] = $this->getEventLabel();
       $arr['class'] = $this->getJsonClassArr();
       return $arr;
   }
    
}