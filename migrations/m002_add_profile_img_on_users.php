<?php


class m002_add_profile_img_on_users extends \Mubangizi\Core\Migration
{
    public function up()
    {
        return $this->db->exec("ALTER TABLE users ADD COLUMN profile_img TINYTEXT;");
    }

    public function down()
    {
        return $this->db->exec("ALTER TABLE users DROP COLUMN profile_img;");
    }
}
