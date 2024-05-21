<?php

use yii\db\Migration;

/**
 * Class m240521_144019_update_user_table_for_soft_deletion
 */
class m240521_144019_update_user_table_for_soft_deletion extends Migration
{
    public function up()
    {
        $this->execute("ALTER TABLE `user` ADD `is_deleted` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0'
            AFTER `is_disabled`, ADD INDEX `index-user-is_deleted` (`is_deleted`)");
    }

    public function down()
    {
        $this->dropColumn('user', 'is_deleted');
    }
}
