<?php

use yii\db\Migration;

/**
 * Class m240905_093422_update_so_table
 */
class m240905_093422_update_so_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("ALTER TABLE `so` ADD `id_unit` SMALLINT NOT NULL AFTER `id`");
        $this->execute("ALTER TABLE `so` ADD INDEX(`id_unit`)");
        $this->execute("ALTER TABLE `so` ADD CONSTRAINT `fk-so-to-unit` FOREIGN KEY (`id_unit`)
            REFERENCES `unit`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT");
        $this->execute("ALTER TABLE `so` ADD `id_quotation` INT NOT NULL AFTER `id`");
        $this->execute("ALTER TABLE `so` ADD INDEX(`id_quotation`)");
        $this->execute("ALTER TABLE `so` ADD CONSTRAINT `fk-so-to-quotation` FOREIGN KEY (`id_quotation`)
            REFERENCES `quotation`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT");
        $this->execute("ALTER TABLE `so` ADD `counter` SMALLINT UNSIGNED NOT NULL AFTER `is_verified`");
        $this->execute("ALTER TABLE `so` ADD `is_deleted` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0'
            AFTER `penutup`, ADD INDEX `index-so-is_deleted` (`is_deleted`)");
        $this->execute("ALTER TABLE `so` ADD `year` YEAR NOT NULL AFTER `timestamp`");
        $this->execute("ALTER TABLE `so` ADD INDEX(`year`)");
        $this->execute("ALTER TABLE `so` ADD `comission` INT UNSIGNED NOT NULL DEFAULT '0' AFTER `year`");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('so', 'comission');
        $this->dropColumn('so', 'year');
        $this->dropColumn('so', 'is_deleted');
        $this->dropColumn('so', 'counter');
        $this->execute("ALTER TABLE `so` DROP FOREIGN KEY `fk-so-to-quotation`");
        $this->dropColumn('so', 'id_quotation');
        $this->execute("ALTER TABLE `so` DROP FOREIGN KEY `fk-so-to-unit`");
        $this->dropColumn('so', 'id_unit');
    }
}
