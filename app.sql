-- MySQL syntax

-- Create the migrations table
CREATE TABLE IF NOT EXISTS migrations (
   id INT(10) AUTO_INCREMENT PRIMARY KEY,
   migration VARCHAR(250),
   created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP);

-- Create the users table
CREATE TABLE IF NOT EXISTS users (
   id INT(10) AUTO_INCREMENT PRIMARY KEY,
   email VARCHAR(180) NOT NULL,
   first_name VARCHAR(100) NOT NULL,
   last_name VARCHAR(100) NOT NULL,
   password_hash VARCHAR(150) NOT NULL,
   active_status TINYINT(1) NOT NULL DEFAULT 0,
   joined_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   UNIQUE INDEX user_email_unique (email ASC));