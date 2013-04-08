<?php

class My_Mod_Model_Resource_Routine extends Mage_Core_Model_Resource_Db_Abstract {

    public function _construct() {
        $this->_init('mymod/routine', 'fuck');
    }

    protected function _afterSave(Mage_Core_Model_Abstract $object) {
        $data = $object->getVids();
        $playlistId = $object->getFuck();
        $routinePos = 1;
        foreach ($data as $vid) {
            $model = Mage::getModel('mymod/routine_vids');
            $model->setVidRoutinePos($routinePos)
                    ->setPlaylistId($playlistId)
                    ->setVidPlaylistPos($vid['pos'])
                    ->setVidId($vid['id'])
                    ->setTitle($vid['title'])
                    ->setThumbUrl($vid['thumbUrl'])
                    ->save();
            $routinePos += 1;
        }
        return parent::_afterSave($object);
    }

}