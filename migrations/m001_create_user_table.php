<?php


class m001_create_user_table extends \Mubangizi\Core\Migration
{
    public function up()
    {
        return $this->db->exec("CREATE TABLE IF NOT EXISTS users (
            id INT(10) AUTO_INCREMENT PRIMARY KEY,
            email VARCHAR(180) NOT NULL,
            first_name VARCHAR(100) NOT NULL,
            last_name VARCHAR(100) NOT NULL,
            password_hash VARCHAR(150) NOT NULL,
            is_active TINYINT DEFAULT 0,
            joined_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            UNIQUE INDEX user_email_unique (email ASC)
        );");
    }

    public function down()
    {
        return $this->db->exec("DROP TABLE users;");
    }
}
