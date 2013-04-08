<?php
class Mgt_DeveloperToolbar_Block_Tab_ConfigDump extends Mgt_DeveloperToolbar_Block_Tab{
   
    protected $_helper;
    protected $_result;
    protected $_stack;
    
    public function __construct($name, $label = '') {
        parent::__construct($name, 'configD');
        $this->setTemplate('mgt_developertoolbar/tab/configdump.phtml');
        $this->setIsActive(true);
        $this->_helper = Mage::helper('mymod/config');
        $this->_result = $this->_helper->getResult(false);
        $this->_stack = $this->_helper->getStack(false);
    }
    public function getCount(){
        if (count($this->_result)>count($this->_stack)){
            return count($this->_result);
        } else {
            return count($this->_stack);
        }
       
    }
    
    
}