<?php

use yii\db\Migration;

/**
 * Class m240710_094749_update_klien_table_for_soft_deletion
 */
class m240710_094749_update_klien_table_for_soft_deletion extends Migration
{
    public function up()
    {
        $this->execute("ALTER TABLE `klien` ADD `is_deleted` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0'
            AFTER `is_disabled`, ADD INDEX `index-klien-is_deleted` (`is_deleted`)");
    }

    public function down()
    {
        $this->dropColumn('klien', 'is_deleted');
    }
}
