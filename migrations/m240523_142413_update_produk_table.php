<?php

use yii\db\Migration;

/**
 * Class m240523_142413_update_produk_table
 */
class m240523_142413_update_produk_table extends Migration
{
    public function safeUp()
    {
        $this->execute("ALTER TABLE `produk` ADD `id_unit` SMALLINT NOT NULL AFTER `id`,
            ADD INDEX `id_unit` (`id_unit`)");
        $this->execute("ALTER TABLE `produk` ADD CONSTRAINT `produk_ibfk_2` FOREIGN KEY (`id_unit`)
            REFERENCES `unit`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT");
    }

    public function safeDown()
    {
        $this->execute("ALTER TABLE `produk` DROP FOREIGN KEY `produk_ibfk_2`");
        $this->dropColumn('produk', 'id_unit');
    }
}
