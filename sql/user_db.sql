drop database app_ly;
create database app_ly;
drop user 'app_ly'@'localhost';
create user 'app_ly'@'localhost' identified by 'app_ly_pass';
grant all privileges on app_ly.* to 'app_ly'@'localhost';
flush privileges;

