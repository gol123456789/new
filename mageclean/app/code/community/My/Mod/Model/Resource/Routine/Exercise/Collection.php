<?php

class My_Mod_Model_Resource_Routine_Exercise_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract {

    public function _construct() {
        $this->_init('mymod/routine_exercise');
    }

    public function loadByRoutine($id) {
        $this->join(
                array('routine' => 'mymod/routine'), 'routine.fuck = main_table.routine_id', array('routine.name'));
        return $this->addFieldToFilter('main_table.routine_id', array('eq' => $id));
    }

    public function loadRequirementsByRoutine($id) {
        $this->getSelect()->reset()
                ->from(
                        array('main_table' => $this->getTable('mymod/routine_exercise')), array())
                ->joinInner(
                        array('er' => $this->getTable('mymod/exercise_requirement')), 'er.exercise_id = main_table.exercise_id', array('id'));
        return $this->addFieldToFilter('main_table.routine_id', array('eq' => $id));
    }

    public function loadRequirementsCatsByRoutine($id) {
        $this->getSelect()->reset()
                ->from(
                        array('main_table' => $this->getTable('mymod/routine_exercise')), array())
                ->joinInner(
                        array('er' => $this->getTable('mymod/exercise_requirement')), 'er.exercise_id = main_table.exercise_id', array()
                )
                ->joinRight(
                        array('cats' => $this->getTable('mymod/exercise_requirement_categories')), 'cats.requirement_id = er.id', array('cats.category_id')
        );
        $this->addFieldToFilter('main_table.routine_id', array('eq' => $id));
        $select = $this->getSelect();
        $resource = $this->getResource()->getReadConnection();
        return $resource->fetchCol($select);
    }

    public function loadCatByStore($id, $request) {
        $root_cat = Mage::app()->getStore()->getRootCategoryId();

        $category_model = Mage::getModel('catalog/category'); //get category model

        $categoryid = $root_cat;

        $_category = $category_model->load($categoryid); //$categoryid for which the child categories to be found        

        $all_child_categories = $category_model->getResource()->getAllChildren($_category); //array consisting of all child categories id
        $requiredArr = $this->loadRequirementsCatsByRoutine($id);
        $storeCatArr = array_intersect($all_child_categories, $requiredArr);

        return $storeCatArr;
    }

}
