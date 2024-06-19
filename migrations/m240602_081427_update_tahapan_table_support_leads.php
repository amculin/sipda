<?php

use yii\db\Migration;

/**
 * Class m240602_081427_update_tahapan_table_support_leads
 */
class m240602_081427_update_tahapan_table_support_leads extends Migration
{
    public function up()
    {
        $this->execute("ALTER TABLE `tahapan` ADD `icon` VARCHAR(48) NOT NULL DEFAULT 'bi bi-grid' AFTER `warna`");
    }

    public function down()
    {
        $this->dropColumn('tahapan', 'icon');
    }
}