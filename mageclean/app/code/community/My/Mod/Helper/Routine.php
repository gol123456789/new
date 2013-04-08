<?php

class My_Mod_Helper_Routine extends Mage_Core_Helper_Abstract {
     
    public function register($request){
        $routineId = (int) $request->getParam('id');
        $routine = Mage::getModel('mymod/routine')->load($routineId);
        Mage::register('routine', $routine);
        Mage::register('routine_id', $routineId);
    }
}