<?php

class Mgt_DeveloperToolbar_Block_Toolbar_Item_ConfigDump extends Mgt_DeveloperToolbar_Block_Toolbar_Item {
    
     public function __construct($name, $label = '')
    {
        parent::__construct($name, 'configD');
      //  $this->setIcon(Mage::helper('mgt_developertoolbar')->getMediaUrl().'mgt_developertoolbar/database.png');
        $this->_content = new Mgt_DeveloperToolbar_Block_TabContainer_ConfigDump('ConfigDump', 'configD');
    }
    
}