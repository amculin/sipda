<?php

use yii\db\Migration;

/**
 * Class m240712_113042_update_broadcast_config_table
 */
class m240712_113042_update_broadcast_config_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("ALTER TABLE `broadcast_config` ADD `id_unit` SMALLINT NOT NULL AFTER `id`");
        $this->execute("ALTER TABLE `broadcast_config` ADD INDEX(`id_unit`)");
        $this->execute("ALTER TABLE `broadcast_config` ADD CONSTRAINT `fk-broadcast_config-to-unit` FOREIGN KEY (`id_unit`)
            REFERENCES `unit`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->execute("ALTER TABLE `broadcast_config` DROP FOREIGN KEY `fk-broadcast_config-to-unit`");
        $this->dropColumn('broadcast_config', 'id_unit');
    }
}
