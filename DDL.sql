CREATE TABLE IF NOT EXISTS `item` (
	`item_id`			INT NOT NULL AUTO_INCREMENT,
	`item_name` 		VARCHAR(64),
	`desc` 				VARCHAR(1024),
	`price` 			INT,
	`discount_price`	INT,
	`quantity` 			INT,
	`img` 				INT,
	`data_added` 		DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`availability` 		BOOLEAN,
	PRIMARY KEY (`item_id`)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `item_tags` (
	`item_id` 			INT NOT NULL AUTO_INCREMENT,
	`tag`				VARCHAR(64),
	FOREIGN KEY (`item_id`) REFERENCES `item`(`item_id`)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `item_catagory` (
	`item_id` 			INT NOT NULL AUTO_INCREMENT,
	`catagory` 			VARCHAR(64),
	FOREIGN KEY (`item_id`) REFERENCES `item`(`item_id`)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `cart` (
	`cart_id`			INT NOT NULL AUTO_INCREMENT, 
	`total_price`		INT, 
	PRIMARY KEY (`cart_id`)
) ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS `order` (
	`order_id`			INT NOT NULL AUTO_INCREMENT, 
	`total_price`		INT,  
	`shipping_name` 	VARCHAR(64),
	`shipping_address`	VARCHAR(64),
	`shipping_phone`	VARCHAR(16),
	`shipping_email`	VARCHAR(30),
	PRIMARY KEY (`order_id`)
) ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS `customer` (
	`customer_id`		INT NOT NULL AUTO_INCREMENT, 
	`img_id`			INT, 
	`account` 			VARCHAR (30),
	`password`			VARCHAR (30),
	PRIMARY KEY (`customer_id`)
) ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS `payment_info` (
	`cardnum`			VARCHAR (16), 
	`expire_date`		DATE, 
	`cardholder` 		VARCHAR (30),
	PRIMARY KEY (`cardnum`)
) ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS `contain` (
	`cart_id`			INT,
	`order_id`			INT,
	`item_id`			INT NOT NULL,
	`quantity`			INT,
	PRIMARY KEY (`cart_id`, `order_id`, `item_id`),
	FOREIGN KEY (`cart_id`) REFERENCES `cart`(`cart_id`),
	FOREIGN KEY (`order_id`) REFERENCES `order`(`order_id`)
) ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS `cart_store`(
	`cart_id`			INT NOT NULL,
	`customer_id`		INT NOT NULL,
	PRIMARY KEY (`cart_id`, `customer_id`),
	FOREIGN KEY (`cart_id`) REFERENCES `cart`(`cart_id`),
	FOREIGN KEY (`customer_id`) REFERENCES `customer`(`customer_id`)
) ENGINE=INNODB;


CREATE TABLE IF NOT EXISTS `own` (
	`customer_id`		INT NOT NULL,
	`cardnum`			VARCHAR (16),
	PRIMARY KEY (`customer_id`, `cardnum`),
	FOREIGN KEY (`customer_id`) REFERENCES `customer`(`customer_id`),
	FOREIGN KEY (`cardnum`) REFERENCES `payment_info`(`cardnum`)
) ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS `pay` (
	`order_id`			INT NOT NULL,
	`cardnum`			VARCHAR (16),
	PRIMARY KEY (`order_id`),
	FOREIGN KEY (`order_id`) REFERENCES `order`(`order_id`),
	FOREIGN KEY (`cardnum`) REFERENCES `payment_info`(`cardnum`)
) ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS `buy` (
	`order_id`			INT NOT NULL,
	`customer_id`		INT NOT NULL,
	PRIMARY KEY (`order_id`),
	FOREIGN KEY (`customer_id`) REFERENCES `customer`(`customer_id`),
	FOREIGN KEY (`order_id`) REFERENCES `order`(`order_id`)
) ENGINE=INNODB;

INSERT INTO `item` (`item_id`, `item_name`, `desc`, `price`, `discount_price`, `quantity`, `img`, `date_added`) VALUES
(1, 'Smart Watch', '<p>Unique watch made with stainless steel, ideal for those that prefer interative watches.</p>\r\n<h3>Features</h3>\r\n<ul>\r\n<li>Powered by Android with built-in apps.</li>\r\n<li>Adjustable to fit most.</li>\r\n<li>Long battery life, continuous wear for up to 2 days.</li>\r\n<li>Lightweight design, comfort on your wrist.</li>\r\n</ul>', '29.99', '0.00', 10, 'watch.jpg', '2019-03-13 17:55:22'),
(2, 'Wallet', '', '14.99', '19.99', 34, 'wallet.jpg', '2019-03-13 18:52:49'),
(3, 'Headphones', '', '19.99', '0.00', 23, 'headphones.jpg', '2019-03-13 18:47:56'),
(4, 'Digital Camera', '', '69.99', '0.00', 7, 'camera.jpg', '2019-03-13 17:42:04');