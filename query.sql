INSERT INTO categories SET categ_name='Доски и лыжи';
INSERT INTO categories SET categ_name='Крепления';
INSERT INTO categories SET categ_name='Ботинки';
INSERT INTO categories SET categ_name='Одежда';
INSERT INTO categories SET categ_name='Инструменты';
INSERT INTO categories SET categ_name='Разное';


INSERT INTO lots SET  lot_categ_id = 2, lot_name = '2014 Rossignol District Snowboard', lot_description='info', lot_img='img/lot-1.jpg', lot_first_price = '10999';
INSERT INTO lots SET  lot_categ_id = 2, lot_name = 'DC Ply Mens 2016/2017 Snowboard', lot_description='info', lot_img='img/lot-2.jpg', lot_first_price = '159999', lot_step = '1000';
INSERT INTO lots SET  lot_categ_id = 3, lot_name = 'Крепления Union Contact Pro 2015 года размер L/XL', lot_description='info', lot_img='img/lot-3.jpg', lot_first_price = '8000';
INSERT INTO lots SET   lot_categ_id = 4, lot_name = 'Ботинки для сноуборда DC Mutiny Charocal', lot_description='info', lot_img='img/lot-4.jpg', lot_first_price = '10999';
INSERT INTO lots SET   lot_categ_id = 5, lot_name = 'Куртка для сноуборда DC Mutiny Charocal', lot_description='info', lot_img='img/lot-5.jpg', lot_first_price = '7500';
INSERT INTO lots SET  lot_categ_id = 6, lot_name = 'Маска Oakley Canopy', lot_description='info', lot_img='img/lot-6.jpg', lot_first_price = '5400', lot_step = '500';

INSERT INTO users SET user_name = 'Admin', user_email = 'admin_1@gmail.com', user_password = 'admin12345', user_signup_date = NOW();
INSERT INTO users SET user_name = 'Ogr', user_email = 'ogr@gmail.com', user_password = 'vfvrbyfrhfcjnrf', user_signup_date = NOW();

INSERT INTO rate SET lot_id = 5, user_id = 1, rate_date = NOW(), rate_price = '1000';
INSERT INTO rate SET lot_id = 10, user_id = 2, rate_date = NOW(), rate_price = '500';



--запросы--

SELECT categ_name FROM `categories`;
SELECT * FROM `lots` WHERE lot_comp_date is NULL;
SELECT lot_id, lot_categ_id, lot_user_id, lot_winner_id, lot_name, lot_description, lot_cr_date, lot_img, lot_first_price, lot_comp_date, lot_step, categ_name FROM `lots`, `categories` WHERE lot_id = '4' AND categ_id = '2';
UPDATE `lots` SET lot_name = '2014 Rossignol District Snowboard Black Edition' WHERE lot_id = 2;
SELECT * FROM `rate` WHERE rate_id = '2' AND DATEDIFF(CURDATE(), rate_date) = 0; 
