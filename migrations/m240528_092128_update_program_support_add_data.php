<?php

use yii\db\Migration;

/**
 * Class m240528_092128_update_program_support_add_data
 */
class m240528_092128_update_program_support_add_data extends Migration
{
    public function safeUp()
    {
        $this->execute("ALTER TABLE `program` DROP PRIMARY KEY, ADD PRIMARY KEY (`id`) USING BTREE");
        $this->execute("ALTER TABLE `program` ADD INDEX(`id_unit`)");
        $this->execute("ALTER TABLE `program` ADD CONSTRAINT `fk-program-to-unit` FOREIGN KEY (`id_unit`)
            REFERENCES `unit`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT");
        $this->execute("ALTER TABLE `program` ADD `counter` TINYINT UNSIGNED NOT NULL AFTER `tanggal_selesai`,
            ADD `year` YEAR NOT NULL AFTER `counter`");
    }

    public function safeDown()
    {
        $this->dropColumn('program', 'year');
        $this->dropColumn('program', 'counter');
        $this->execute("ALTER TABLE `program` DROP FOREIGN KEY `fk-program-to-unit`");
        $this->execute("ALTER TABLE `program` DROP INDEX `id_unit`");
        $this->execute("ALTER TABLE `program` DROP PRIMARY KEY, ADD PRIMARY KEY (`id`, `id_unit`) USING BTREE");
    }
}
