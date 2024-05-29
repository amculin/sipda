<?php

use yii\db\Migration;

/**
 * Class m240529_133307_update_channel_table_for_soft_deletion
 */
class m240529_133307_update_channel_table_for_soft_deletion extends Migration
{
    public function up()
    {
        $this->execute("ALTER TABLE `channel` ADD `is_deleted` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0'
            AFTER `keterangan`, ADD INDEX `index-channel-is_deleted` (`is_deleted`)");
    }

    public function down()
    {
        $this->dropColumn('channel', 'is_deleted');
    }
}
