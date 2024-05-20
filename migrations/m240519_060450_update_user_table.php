<?php

use yii\db\Migration;

/**
 * Class m240519_060450_update_user_table
 */
class m240519_060450_update_user_table extends Migration
{
    public function safeUp()
    {
        $data = [
            'id_unit' => 1,
            'id_grup' => 1,
            'username' => 'admin',
            'password' => \Yii::$app->getSecurity()->generatePasswordHash('S1pDa-PKU'),
            'auth_key' => null,
            'nama' => 'Administrator',
            'email' => 'admin@gmail.com',
            'jabatan' => null,
            'komisi_jabatan' => 0,
            'is_disabled' => 0,
            'last_login' => null,
        ];

        $this->execute('ALTER TABLE `user` ADD `auth_key` VARCHAR(128) NULL AFTER `password`');
        $this->upsert('user', $data, ['password' => \Yii::$app->getSecurity()->generatePasswordHash('S1pDa-PKU')]);
    }

    public function safeDown()
    {
        $this->dropColumn('user', 'auth_key');
    }
}
