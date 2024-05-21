<?php

use yii\db\Migration;

/**
 * Class m240521_145843_update_plan_table_for_soft_deletion
 */
class m240521_145843_update_plan_table_for_soft_deletion extends Migration
{
    public function up()
    {
        $this->execute("ALTER TABLE `plan` ADD `is_deleted` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0'
            AFTER `target_komisi`, ADD INDEX `index-plan-is_deleted` (`is_deleted`)");
    }

    public function down()
    {
        $this->dropColumn('plan', 'is_deleted');
    }
}
