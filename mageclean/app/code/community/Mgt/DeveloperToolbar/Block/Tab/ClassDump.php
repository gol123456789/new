<?php
class Mgt_DeveloperToolbar_Block_Tab_ClassDump extends Mgt_DeveloperToolbar_Block_Tab{
   
    protected $_helper;
    protected $_result;
    protected $_stack;
    
    public function __construct($name, $label = '') {
        parent::__construct($name, $label);
        $this->setTemplate('mgt_developertoolbar/tab/classdump.phtml');
        $this->setIsActive(true);
        
    }   
    
}