<?php

use yii\db\Migration;

/**
 * Class m240712_072914_update_klien_kontak_for_soft_deletion
 */
class m240712_072914_update_klien_kontak_for_soft_deletion extends Migration
{
    public function up()
    {
        $this->execute("ALTER TABLE `klien_kontak` ADD `is_deleted` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0'
            AFTER `is_disabled`, ADD INDEX `index-klien_kontak-is_deleted` (`is_deleted`)");
    }

    public function down()
    {
        $this->dropColumn('klien_kontak', 'is_deleted');
    }
}
