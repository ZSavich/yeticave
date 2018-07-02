USE yeticave;

INSERT INTO categories (name) VALUES ('Доски и лыжи'), ('Крепления'), ('Ботинки'), ('Одежда'), ('Инструменты'), ('Разное');

INSERT INTO lots (name, description, price, step, image, category_id, user_id, winner_id, create_date, expire_date) VALUES 
	('2014 Rossiglon District Snowboard', 'Описание отсутствует', 10999, 100, 'img/lot-1.jpg', 1, 1, 4, 1512328601, 1513428601),
	('DC Ply Mens 2016/2017 Snowboard', 'Описание отсутствует', 159999, 500, 'img/lot-2.jpg', 1, 2, 4, 1512328601, 1512428601),
	('Креаления Union Contact Pro 2015 года размер L/XL', 'Описание отсутствует', 8000, 50, 'img/lot-3.jpg', 2, 1, 3, 1512328601, 1513428601),
	('Ботинки для сноуборда DC Mutiny Charocal', 'Описание отсутствует', 10999, 250, 'img/lot-4.jpg', 3, 2, 4, 1512428601, 1512428601),
	('Куртка для сноуборда DC Mutiny Charocal', 'Описание отсутствует', 7500, 150, 'img/lot-5.jpg', 4, 1, 3, 1512428601, 1512428601),
	('Маска Oakley Canopy', 'Описание отсутствует', 5400, 100, 'img/lot-6.jpg', 6, 2, 3, 1512328601, 1512428601);
	
INSERT INTO users (name, email, password_hash, contacts, registration_date, avatar) VALUES
	('Игнат', 'ignat.v@gmail.com', '$2y$10$OqvsKHQwr0Wk6FMZDoHo1uHoXd4UdxJG/5UDtUiie00XaxMHrW8ka', 'Отсутсвуют', 1530451048, ''),
	('Леночка', 'kitty_93@li.ru', '$2y$10$bWtSjUhwgggtxrnJ7rxmIe63ABubHQs0AS0hgnOo41IEdMHkYoSVa', 'Отсутсвуют', 1530451048, ''),
	('Руслан', 'warrior07@mail.ru', '$2y$10$2OxpEH7narYpkOT1H5cApezuzh10tZEEQ2axgFOaKW.55LxIJBgWW', 'Отсутсвуют', 1530451048, ''),
	('Саня', 'alexander@mail.ru', '$2y$10$2OxpEH7narYpkOT1H5cApezuzh10tZEEQ2axgFOaKW.55LxIJBgWW', 'Отсутсвуют', 1530451048, '');
	
INSERT INTO bets (create_date, value, lot_id, user_id) VALUES 
	(1512331601, 8600, 3, 2),
	(1512331601, 9400, 3, 3),
	(1512331601, 10000, 2, 4);
	
/* Получить все категории */
SELECT * FROM categories;

/* Получить самые новые, открытые лоты*/
/* SELECT l.name, l.price, l.image , COUNT(b), c.name FROM lots l INNER JOIN categories c ON l.category_id = c.id INNER JOIN bets b ON l.id = b.lot_id; */
SELECT l.name, l.price, l.image FROM lots l;

/* Показать лот по его id*/
SELECT l.name, l.price, c.name FROM lots l INNER JOIN categories c ON l.category_id = c.id WHERE l.id = 4;

/**/

/**/

/**/