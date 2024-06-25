<?php

use yii\db\Migration;

/**
 * Class m240625_085035_update_quotation_table_for_soft_deletion
 */
class m240625_085035_update_quotation_table_for_soft_deletion extends Migration
{
    public function up()
    {
        $this->execute("ALTER TABLE `quotation` ADD `is_deleted` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0'
            AFTER `timestamp`, ADD INDEX `index-quotation-is_deleted` (`is_deleted`)");
    }

    public function down()
    {
        $this->dropColumn('quotation', 'is_deleted');
    }
}
