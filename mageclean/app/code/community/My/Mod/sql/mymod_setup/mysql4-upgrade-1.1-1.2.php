<?php

$installer = $this;

$installer->startSetup();


$installer->run("
CREATE TABLE IF NOT EXISTS {$this->getTable('mymod/exercise_suggestion')} (
 `id` INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
 `exercise_id` INT(11) NOT NULL ,
 `post_id` INT( 11 ) unsigned NOT NULL,
 `store_id` TINYINT( 4 ) NOT NULL ,
  foreign key(`exercise_id`) references exercise(`id`),
  foreign key(`post_id`) references aw_blog(`post_id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8;
");

$installer->endSetup();

