<?php

use yii\db\Migration;

/**
 * Class m240522_081646_update_config_table
 */
class m240522_081646_update_config_table extends Migration
{
    public function safeUp()
    {
        $this->execute('TRUNCATE TABLE `config`');
        $this->execute('ALTER TABLE `config` DROP `nama`, DROP `value`');
        $this->execute('ALTER TABLE `config` CHANGE `id` `id` TINYINT NOT NULL AUTO_INCREMENT');
        $this->execute('ALTER TABLE `config` ADD `config` JSON NOT NULL');
    }

    public function safeDown()
    {
        $this->execute('ALTER TABLE `config` DROP `config`');
        $this->execute('ALTER TABLE `config` ADD `nama` VARCHAR(32) NULL AFTER `id_unit`');
        $this->execute('ALTER TABLE `config` ADD `value` VARCHAR(100) NULL');
        $this->execute("INSERT INTO `config` (`id`, `id_unit`, `nama`, `value`) VALUES
            (1, 1, 'smtp_host', 'localhost'),
            (2, 1, 'smtp_port', '25'),
            (3, 1, 'smtp_user', 'jmc'),
            (4, 1, 'smtp_password', '*******'),
            (5, 1, 'smtp_email', 'test_admin@jmc.co.id'),
            (6, 1, 'smtp_nama', 'Administrator'),
            (7, 1, 'komisi_mencapai_target', '0'),
            (8, 1, 'prosentase_komisi', '0')
        ");
    }
}
