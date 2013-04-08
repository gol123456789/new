CREATE TABLE IF NOT EXISTS `exercise_test` (
 `id` INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
 `user_id` INT(10) unsigned,
 `name ` VARCHAR(255),
 `created_at` datetime default NULL, 
FOREIGN KEY (`user_id`) REFERENCES `customer_entity`(`entity_id`)
 
) ENGINE = InnoDB DEFAULT CHARSET = utf8;
