<?php

use yii\db\Migration;

/**
 * Class m240625_083152_update_quotation_table
 */
class m240625_083152_update_quotation_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("ALTER TABLE `quotation` ADD `id_unit` SMALLINT NOT NULL AFTER `id`");
        $this->execute("ALTER TABLE `quotation` ADD INDEX(`id_unit`)");
        $this->execute("ALTER TABLE `quotation` ADD CONSTRAINT `fk-quotation-to-unit` FOREIGN KEY (`id_unit`)
            REFERENCES `unit`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT");
        $this->execute("ALTER TABLE `quotation` ADD `year` YEAR NOT NULL AFTER `timestamp`");
        $this->execute("ALTER TABLE `quotation` ADD INDEX(`year`)");
        $this->execute("ALTER TABLE `quotation` ADD `counter` SMALLINT UNSIGNED NOT NULL AFTER `year`");
        $this->execute("ALTER TABLE `quotation` CHANGE `kode` `kode` CHAR(12) CHARACTER SET utf8mb4
            COLLATE utf8mb4_general_ci NOT NULL;");

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->execute("ALTER TABLE `quotation` DROP FOREIGN KEY `fk-quotation-to-unit`");
        $this->dropColumn('quotation', 'id_unit');
        $this->dropColumn('quotation', 'year');
        $this->dropColumn('quotation', 'counter');
        $this->execute("ALTER TABLE `quotation` CHANGE `kode` `kode` VARCHAR(64) CHARACTER SET utf8mb4
            COLLATE utf8mb4_general_ci NOT NULL;");
    }
}
