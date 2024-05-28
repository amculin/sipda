<?php

use yii\db\Migration;

/**
 * Class m240528_044446_update_program_table_for_soft_deletion
 */
class m240528_044446_update_program_table_for_soft_deletion extends Migration
{
    public function up()
    {
        $this->execute("ALTER TABLE `program` ADD `is_deleted` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0'
            AFTER `is_disabled`, ADD INDEX `index-program-is_deleted` (`is_deleted`)");
    }

    public function down()
    {
        $this->dropColumn('program', 'is_deleted');
    }
}