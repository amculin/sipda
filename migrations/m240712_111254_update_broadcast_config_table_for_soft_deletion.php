<?php

use yii\db\Migration;

/**
 * Class m240712_111254_update_broadcast_config_table_for_soft_deletion
 */
class m240712_111254_update_broadcast_config_table_for_soft_deletion extends Migration
{
    public function up()
    {
        $this->execute("ALTER TABLE `broadcast_config` ADD `is_deleted` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0'
            AFTER `signature`, ADD INDEX `index-broadcast_config-is_deleted` (`is_deleted`)");
    }

    public function down()
    {
        $this->dropColumn('broadcast_config', 'is_deleted');
    }
}
