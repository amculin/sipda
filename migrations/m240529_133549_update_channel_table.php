<?php

use yii\db\Migration;

/**
 * Class m240529_133549_update_channel_table
 */
class m240529_133549_update_channel_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("ALTER TABLE `channel` ADD `id_unit` SMALLINT NOT NULL AFTER `id`");
        $this->execute("ALTER TABLE `channel` ADD INDEX(`id_unit`)");
        $this->execute("ALTER TABLE `channel` ADD CONSTRAINT `fk-channel-to-unit` FOREIGN KEY (`id_unit`)
            REFERENCES `unit`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT");
        //$this->dropColumn('channel', 'timestamp');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        //$this->execute("ALTER TABLE `channel` ADD `timestamp` INT NOT NULL AFTER `is_deleted`");
        $this->execute("ALTER TABLE `channel` DROP FOREIGN KEY `fk-channel-to-unit`");
        $this->dropColumn('channel', 'id_unit');
    }
}
