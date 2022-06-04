Need database name test2

********************************
********************************

Need table name customers

CREATE TABLE `shoeshop`.`customers` ( `id` INT NULL , `name` VARCHAR(50) NOT NULL , `surname` VARCHAR(50) NOT NULL , 
`phone` VARCHAR(10) NOT NULL , `email` VARCHAR(50) NOT NULL , `insert_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP) ENGINE = InnoDB;
