drop database applicationtracker;
create database applicationtracker;
create user 'applicationtracker'@'localhost' identified by 'password';
grant all privileges on applicationtracker.* to 'applicationtracker'@'localhost';
flush privileges;

