<?php

class My_Mod_Block_Routinelist extends Mage_Core_Block_Template {
    public function getid() {
        return Mage::registry('routine_id');
    }
    public function getFeedArr() {
        $playlistId = $this->getId();
        $model = Mage::getModel('mymod/routine_vids');
        $collection = $model->getCollection()->addFieldToFilter('playlist_id', $playlistId)->setOrder('vid_routine_pos', 'ASC');
        $string = $collection->getSelect()->__toString();
        $arrr = array();
        foreach ($collection as $value) {
            var_dump($value);
            array_push($arrr, $value->getData());
        }
        return $arrr;
    }

}