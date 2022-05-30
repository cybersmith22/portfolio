-- create and select the database
USE smith;  -- MySQL command

-- drop tables if already exist
DROP TABLE IF EXISTS cart;
DROP TABLE IF EXISTS inventory;
DROP TABLE IF EXISTS customer;

-- create the tables
CREATE TABLE inventory (
  itemNumber	INT(5)		   NOT NULL,
  description   VARCHAR(50)    NOT NULL,
  price			DECIMAL(4, 2)  NOT NULL,
  quantity	    INT(3)		   NOT NULL,
  PRIMARY KEY (itemNumber)
);

CREATE TABLE cart (
  itemNumber	INT(5)		   NOT NULL,
  quantity	    INT(3)		   NOT NULL,
  PRIMARY KEY (itemNumber),
  CONSTRAINT FOREIGN KEY (itemNumber) REFERENCES inventory(itemNumber)  
);

CREATE TABLE customer (
  username VARCAR(50)	NOT NULL,
  password VARCHAR(15)  NOT NULL,
  firstName VARCHAR(30) NOT NULL,
  lastName VARCHAR(30) 	NOT NULL,
  streetAddress VARCHAR(30) NOT NULL,
  city	VARCHAR(30) NOT NULL,
  userState VARCHAR(15) NOT NULL,
  zip	VARCHAR(10)	NOT NULL,
  PRIMARY KEY (username)
);
-- populate the database
INSERT INTO inventory (itemNumber, description, price, quantity)
VALUES
(1, 'Animal Crossing: New Horizons', 50.00, 4),
(2, 'Skyrim', 30.00, 7),
(3, 'Fallout 76', 45.00, 4),
(4, 'Doom 3', 15.00, 3),
(5, 'Return to Castle Wolfenstein', 5.00, 4),
(6, 'Fallout 4 VR', 60.00, 8),
(7, 'Grand Theft Auto 5', 30.00, 6),
(8, 'Just Cause 4', 40.00, 7),
(9, 'Cyberpunk 2077', 60.00, 9),
(10, 'Doom Eternal', 60.00, 7);