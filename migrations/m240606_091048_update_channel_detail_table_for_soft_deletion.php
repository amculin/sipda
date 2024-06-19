<?php

use yii\db\Migration;

/**
 * Class m240606_091048_update_channel_detail_table_for_soft_deletion
 */
class m240606_091048_update_channel_detail_table_for_soft_deletion extends Migration
{
    public function up()
    {
        $this->execute("ALTER TABLE `channel_detail` ADD `is_deleted` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0'
            AFTER `id_lead`, ADD INDEX `index-channel_detail-is_deleted` (`is_deleted`)");
    }

    public function down()
    {
        $this->dropColumn('channel_detail', 'is_deleted');
    }
}
