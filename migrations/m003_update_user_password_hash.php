<?php

class m003_update_user_password_hash extends \Mubangizi\Core\Migration
{
    public function up()
    {
        return $this->db->exec("ALTER TABLE users CHANGE COLUMN password_hash password_hash VARCHAR(255) NOT NULL;");
    }

    public function down()
    {
        return $this->db->exec("ALTER TABLE users CHANGE COLUMN password_hash password_hash VARCHAR(150) NOT NULL;");
    }
}
