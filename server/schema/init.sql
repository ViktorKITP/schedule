CREATE TABLE `course` (
	`id` INT(11)  AUTO_INCREMENT PRIMARY KEY,
	`name` VARCHAR(10) NULL DEFAULT NULL
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB
;
CREATE TABLE `group` (
	`id` INT(11) AUTO_INCREMENT PRIMARY KEY,
	`name` VARCHAR(50) DEFAULT NULL
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB
;
CREATE TABLE `course_group` (
	`id` INT(11) AUTO_INCREMENT PRIMARY KEY,
	`course_id` INT(11) NOT NULL,
	`group_id` INT(11) not NULL,
	FOREIGN KEY (course_id) REFERENCES course (id) on DELETE CASCADE
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB
;
CREATE TABLE `schedule` (
	`id` INT(11) AUTO_INCREMENT PRIMARY KEY,
	`DAY` VARCHAR(10) NOT NULL,
	`TIME` VARCHAR(5) NOT NULL,
	`VALUE` VARCHAR(50) NOT NULL,
	`GROUP_ID` INT(11) NOT NULL
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB
;

