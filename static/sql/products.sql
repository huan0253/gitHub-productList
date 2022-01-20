Drop database if exists ecommerce;
Drop user if exists 'Adam'@'%';
CREATE DATABASE ecommerce;

CREATE USER 'Adam'@'%' IDENTIFIED BY '1234';
GRANT ALL ON *.* TO 'Adam'@'%';
FLUSH PRIVILEGES;

USE ecommerce;

CREATE TABLE products(
id int not null auto_increment,
type VARCHAR(50) NOT NULL,
code VARCHAR(50) NOT NULL,
name VARCHAR(50) NOT NULL,
price double NOT NULL,
PRIMARY KEY (id)
);