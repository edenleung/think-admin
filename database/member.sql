CREATE TABLE `member` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`username` VARCHAR(50) NOT NULL COLLATE 'utf8mb4_unicode_ci',
	`password` VARCHAR(255) NOT NULL COLLATE 'utf8mb4_unicode_ci',
	`create_time` INT(11) NOT NULL DEFAULT '0',
	`update_time` INT(11) NOT NULL DEFAULT '0',
	`delete_time` INT(11) NOT NULL DEFAULT '0',
	PRIMARY KEY (`id`)
)
COLLATE='utf8mb4_unicode_ci' ENGINE=InnoDB;
