<?php

use yii\db\Migration;

/**
 * Class m240604_134726_update_aktivitas_table_for_soft_deletion
 */
class m240604_134726_update_aktivitas_table_for_soft_deletion extends Migration
{
    public function up()
    {
        $this->execute("ALTER TABLE `aktivitas` ADD `is_deleted` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0'
            AFTER `id_status`, ADD INDEX `index-aktivitas-is_deleted` (`is_deleted`)");
    }

    public function down()
    {
        $this->dropColumn('aktivitas', 'is_deleted');
    }
}
