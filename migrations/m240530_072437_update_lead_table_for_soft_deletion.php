<?php

use yii\db\Migration;

/**
 * Class m240530_072437_update_lead_table_for_soft_deletion
 */
class m240530_072437_update_lead_table_for_soft_deletion extends Migration
{
    public function up()
    {
        $this->execute("ALTER TABLE `lead` ADD `is_deleted` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0'
            AFTER `nilai`, ADD INDEX `index-lead-is_deleted` (`is_deleted`)");
    }

    public function down()
    {
        $this->dropColumn('lead', 'is_deleted');
    }
}
