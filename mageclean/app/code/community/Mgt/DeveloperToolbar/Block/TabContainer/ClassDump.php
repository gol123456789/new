<?php

class Mgt_DeveloperToolbar_Block_TabContainer_ClassDump extends Mgt_DeveloperToolbar_Block_TabContainer {
    
    public function __construct($name) 
    {
        parent::__construct($name);
        $this->addTab(new Mgt_DeveloperToolbar_Block_Tab_ClassDump('ClassDump', 'ClassDump'));
    }
}