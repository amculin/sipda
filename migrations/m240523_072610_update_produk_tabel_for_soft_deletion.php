<?php

use yii\db\Migration;

/**
 * Class m240523_072610_update_produk_tabel_for_soft_deletion
 */
class m240523_072610_update_produk_tabel_for_soft_deletion extends Migration
{
    public function safeUp()
    {
        $this->execute("ALTER TABLE `produk` ADD `is_deleted` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0'
            AFTER `nominal_komisi`, ADD INDEX `index-produk-is_deleted` (`is_deleted`)");
    }

    public function safeDown()
    {
        $this->dropColumn('produk', 'is_deleted');
    }
}
