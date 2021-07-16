CREATE DATABASE `crud-advise`
DEFAULT CHARACTER SET utf8
DEFAULT COLLATE utf8_general_ci;

USE `crud-advise`;

CREATE TABLE `customers`(
    `id` int NOT NULL AUTO_INCREMENT,
    `name` varchar(40) NOT NULL,
    `email` varchar(40) NOT NULL UNIQUE,
    `phone` varchar(20),
    PRIMARY KEY (`id`)
);
