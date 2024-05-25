<?php

use yii\db\Migration;

/**
 * Class m240525_023416_update_tahapan_table_for_soft_deletion
 */
class m240525_023416_update_tahapan_table_for_soft_deletion extends Migration
{
    public function safeUp()
    {
        $this->execute("ALTER TABLE `tahapan` ADD `is_deleted` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0'
            AFTER `warna`, ADD INDEX `index-tahapan-is_deleted` (`is_deleted`)");
    }

    public function safeDown()
    {
        $this->dropColumn('tahapan', 'is_deleted');
    }
}
