<?php

use yii\db\Migration;

/**
 * Class m240522_160333_update_kategori_tabel_for_soft_deletion
 */
class m240522_160333_update_kategori_tabel_for_soft_deletion extends Migration
{
    public function up()
    {
        $this->execute("ALTER TABLE `kategori` ADD `is_deleted` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0'
            AFTER `nama`, ADD INDEX `index-kategori-is_deleted` (`is_deleted`)");
    }

    public function down()
    {
        $this->dropColumn('kategori', 'is_deleted');
    }
}
