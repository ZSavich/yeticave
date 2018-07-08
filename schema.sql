CREATE DATABASE IF NOT EXISTS yeticave 
	DEFAULT CHARACTER SET utf8
	DEFAULT COLLATE utf8_general_ci;
USE yeticave;

CREATE TABLE categories (
	id INT AUTO_INCREMENT PRIMARY KEY,
	name CHAR(30)
);
CREATE UNIQUE INDEX id ON categories(id);

CREATE TABLE lots (
	id INT AUTO_INCREMENT PRIMARY KEY,
	name CHAR(128),
	description TEXT,
	price INT,
	step INT,
	image CHAR(64),
	category_id CHAR(10),
	user_id INT,
	winner_id INT,
	create_date INT,
	expire_date INT
);
CREATE UNIQUE INDEX id ON lots(id);
CREATE INDEX price ON lots(price);
CREATE INDEX step ON lots(step);
CREATE INDEX create_date ON lots(create_date);
CREATE INDEX expire_date ON lots(expire_date);
CREATE INDEX category_id ON lots(category_id);
CREATE INDEX user_id ON lots(user_id);
CREATE INDEX winner_id ON lots(winner_id);

CREATE TABLE bets (
	id INT AUTO_INCREMENT PRIMARY KEY,
	create_date INT,
	value INT,
	lot_id INT,
	user_id INT
);
CREATE UNIQUE INDEX id ON bets(id);
CREATE INDEX value ON bets(value);
CREATE INDEX lot_id ON bets(lot_id);
CREATE INDEX user_id ON bets(user_id);

CREATE TABLE users (
	id INT AUTO_INCREMENT PRIMARY KEY,
	name CHAR(24),
	email CHAR(32),
	password_hash CHAR(60),
	contacts CHAR(255),
	registration_date INT,
	avatar CHAR(128)
);
CREATE UNIQUE INDEX id ON users(id);
CREATE UNIQUE INDEX email ON users(email);

CREATE FULLTEXT INDEX lot_search ON lots(name, description);
	