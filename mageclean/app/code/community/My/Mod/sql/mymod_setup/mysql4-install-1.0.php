<?php

$installer = $this;

$installer->startSetup();


$installer->run("
CREATE TABLE IF NOT EXISTS `{$this->getTable('mymod/exercise')}` (
 `id` INT( 10 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
 `user_id` INT(10) unsigned,
 `name` VARCHAR(255),
 `created_at` datetime default NULL, 
FOREIGN KEY (`user_id`) REFERENCES `customer_entity`(`entity_id`)

) ENGINE = InnoDB DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `{$this->getTable('mymod/exercise_vid')}` (
 `id` int unsigned not null auto_increment primary key, 
 `exercise_id` INT(10),
 `vid_id` VARCHAR(255),
 `created_at` datetime default NULL, 
FOREIGN KEY (`exercise_id`) REFERENCES `{$this->getTable('mymod/exercise')}`(`id`)

) ENGINE = InnoDB DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `{$this->getTable('mymod/exercise_store')}` (
 
 `exercise_id` INT(10),
 `store_id` SMALLINT(5) unsigned,
  FOREIGN KEY (`store_id`) REFERENCES `core_store`(`store_id`),
FOREIGN KEY (`exercise_id`) REFERENCES `{$this->getTable('mymod/exercise')}`(`id`)

) ENGINE = InnoDB DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `{$this->getTable('mymod/exercise_suggestion')}` (
 `id` INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
 `exercise_id` INT(10),
`short_text` TEXT,
`suggestion` TEXT,
  `blog_id` INT(11) unsigned,
FOREIGN KEY (`exercise_id`) REFERENCES `{$this->getTable('mymod/exercise')}`(`id`),
FOREIGN KEY (`blog_id`) REFERENCES `aw_blog`(`post_id`)

) ENGINE = InnoDB DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `{$this->getTable('mymod/exercise_requirement')}` (
 `id` INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
 `exercise_id` INT(10),
`short_text` TEXT,
`suggestion` TEXT,
`product_id` INT(10) unsigned,
FOREIGN KEY (`exercise_id`) REFERENCES `{$this->getTable('mymod/exercise')}`(`id`),
FOREIGN KEY (`product_id`) REFERENCES `catalog_product_entity`(`entity_id`)

) ENGINE = InnoDB DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `{$this->getTable('mymod/exercise_category')}` (
 `cat_id` INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
 `title` VARCHAR(255),
`identifier` VARCHAR(255),
`sort_order` TINYINT(6) unsigned,
`meta_keywords` TEXT,
`meta_description` TEXT



) ENGINE = InnoDB DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `{$this->getTable('mymod/exercise_category_store')}` (
 `cat_id` INT( 11 ),
 `store_id` SMALLINT(5) unsigned,
  FOREIGN KEY (`store_id`) REFERENCES `core_store`(`store_id`),

FOREIGN KEY (`cat_id`) REFERENCES `{$this->getTable('mymod/exercise_category')}`(`cat_id`)

) ENGINE = InnoDB DEFAULT CHARSET = utf8;

");

$installer->endSetup();

