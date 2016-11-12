CREATE DATABASE IF NOT EXISTS dbCustomerManager CHARACTER SET utf8mb4;
USE dbCustomerManager;

CREATE TABLE IF NOT EXISTS AdminUser(
  ID INT UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT,
  Name VARCHAR(25) NOT NULL UNIQUE ,
  Password VARCHAR(32) NOT NULL ,
  salt CHAR(4) NOT NULL ,
  UserType ENUM('0','1')
);

CREATE TABLE IF NOT EXISTS Customer(
  C_ID BIGINT UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT,
  C_Name VARCHAR(10) NOT NULL ,
  Gender ENUM('male','female') DEFAULT 'male',
  C_Address VARCHAR(60) NOT NULL ,
  Phone VARCHAR(20) NOT NULL
);

CREATE TABLE IF NOT EXISTS AdminUserLoginLog(
  AdminID int UNSIGNED NOT NULL ,
  LastLoginTime DATETIME NOT NULL ,
  LastLoginIP VARCHAR(35) NOT NULL ,
  CONSTRAINT FK_AdminID FOREIGN KEY (AdminID) REFERENCES AdminUser(ID)
);

INSERT INTO AdminUser SET Name='admin',Password=MD5('123456msho'),salt='msho',UserType='1';
INSERT INTO AdminUser SET Name='Demo1',Password=MD5('123456demo'),salt='demo',UserType='0';

INSERT INTO Customer SET C_Name='张三',Gender='male',C_Address='广州市XX区XX路XX号',Phone='13412345678';
INSERT INTO Customer SET C_Name='李四',Gender='female',C_Address='广州市XX区XX路XX号',Phone='13712345678';
INSERT INTO Customer SET C_Name='王五',Gender='male',C_Address='广州市XX区XX路XX号',Phone='13912345678';