#This stores users information/details entered by the user 
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(150) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  role ENUM('admin','user') NOT NULL,
);

# This code stores information on all items that can be rented and also tracks the items available for rent
CREATE TABLE equipment (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(150),
  total-_quantity INT NOT NULL,
  quantity_available INT NOT NULL CHECK,
);

# This code is for all rents that take place with dates and current status
CREATE TABLE rentals (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  rented_at DATETIME NOT NULL,
  due_at DATETIME NOT NULL,
  returned_at DATETIME NULL,
  status ENUM('rented','returned','overdue') NOT NULL DEFAULT 'rented',
  FOREIGN KEY (user_id) REFERENCES users(id),
);
# This links equipment items to a rental
CREATE TABLE rental_items (
  id INT AUTO_INCREMENT PRIMARY KEY,
  rental_id INT NOT NULL,
  equipment_id INT NOT NULL,
  quantity INT NOT NULL,
  FOREIGN KEY (rental_id) REFERENCES rentals(id),
  FOREIGN KEY (equipment_id) REFERENCES equipment(id)
);