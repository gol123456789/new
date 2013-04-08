<?php

class Mgt_DeveloperToolbar_Block_TabContainer_ConfigDump extends Mgt_DeveloperToolbar_Block_TabContainer {
    
    public function __construct($name) 
    {
        parent::__construct($name);
        $this->addTab(new Mgt_DeveloperToolbar_Block_Tab_ConfigDump('ConfigDump', 'ConfigDump'));
    }
}