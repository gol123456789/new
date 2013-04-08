<?php

class My_Mod_Helper_Config extends My_Mod_Helper_Data {
    
    public function log($data, $path) {
        $data = array($data,$path);
        $this->setResult($data, false);
        $this->setStack();
    }
}