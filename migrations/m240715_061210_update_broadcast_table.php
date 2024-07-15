<?php

use yii\db\Migration;

/**
 * Class m240715_061210_update_broadcast_table
 */
class m240715_061210_update_broadcast_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("ALTER TABLE `broadcast` ADD `id_unit` SMALLINT NOT NULL AFTER `id`");
        $this->execute("ALTER TABLE `broadcast` ADD INDEX(`id_unit`)");
        $this->execute("ALTER TABLE `broadcast` ADD CONSTRAINT `fk-broadcast-to-unit` FOREIGN KEY (`id_unit`)
            REFERENCES `unit`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT");
        $this->execute("ALTER TABLE `broadcast` ADD `id_channel` INT NOT NULL AFTER `kode`");
        $this->execute("ALTER TABLE `broadcast` ADD INDEX(`id_channel`)");
        $this->execute("ALTER TABLE `broadcast` ADD CONSTRAINT `fk-broadcast-to-channel` FOREIGN KEY (`id_channel`)
            REFERENCES `channel`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->execute("ALTER TABLE `broadcast` DROP FOREIGN KEY `fk-broadcast-to-unit`");
        $this->dropColumn('broadcast', 'id_unit');
        $this->execute("ALTER TABLE `broadcast` DROP FOREIGN KEY `fk-broadcast-to-channel`");
        $this->dropColumn('broadcast', 'id_channel');
    }
}
