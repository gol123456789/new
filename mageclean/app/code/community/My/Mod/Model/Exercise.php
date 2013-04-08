<?php

class My_Mod_Model_Exercise extends Mage_Core_Model_Abstract {
    
    public function _construct() {
        $this->_init("mymod/exercise");
    }
    public function getRequirements(){
        // load collection of Exercise_requirements
        // store the collecttion in $this->_requirementsCollection
        // insert the id's into this models data
    }

    public function getAllowedExerciseCollection($arrOfRequirements){
        // this table and exercise requirement table 
        // select distinct tableOne.id from tableOne
        //  where tableOne.id NOT IN 
        //  (
        //  SELECT DISTINCT condTable.id from condTable 
        //  where condTable.fk_id NOT IN $arrOfRequirements
        //  )
      
    }
  
}