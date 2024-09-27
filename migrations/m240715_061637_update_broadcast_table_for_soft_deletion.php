<?php

use yii\db\Migration;

/**
 * Class m240715_061637_update_broadcast_table_for_soft_deletion
 */
class m240715_061637_update_broadcast_table_for_soft_deletion extends Migration
{
    public function up()
    {
        $this->execute("ALTER TABLE `broadcast` ADD `is_deleted` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0'
            AFTER `id_status`, ADD INDEX `index-broadcast-is_deleted` (`is_deleted`)");
    }

    public function down()
    {
        $this->dropColumn('broadcast', 'is_deleted');
    }
}
