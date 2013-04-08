<?php

class Mgt_DeveloperToolbar_Block_Toolbar_Item_ClassDump extends Mgt_DeveloperToolbar_Block_Toolbar_Item {
    
     public function __construct($name, $label = '')
    {
        parent::__construct($name, $label);
      //  $this->setIcon(Mage::helper('mgt_developertoolbar')->getMediaUrl().'mgt_developertoolbar/database.png');
        $this->_content = new Mgt_DeveloperToolbar_Block_TabContainer_ClassDump('ClassDump', 'classD');
    }
    
}