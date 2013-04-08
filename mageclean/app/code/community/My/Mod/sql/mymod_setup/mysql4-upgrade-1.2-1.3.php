<?php

$installer = $this;

$installer->startSetup();
 // ALTER TABLE {$this->getTable('mymod/exercise_requirement')} DROP tag ; 
  // ALTER TABLE {$this->getTable('mymod/exercise_requirement')} DROP tag_count;

$installer->run("


     ALTER TABLE {$this->getTable('mymod/exercise_requirement')} ADD cat_id INT (10) unsigned;
         ALTER TABLE {$this->getTable('mymod/exercise_requirement')} 
  ADD CONSTRAINT my_new_con
    FOREIGN KEY (cat_id)
    REFERENCES catalog_category_entity (entity_id)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT;
 
");

$installer->endSetup();

