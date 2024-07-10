<?php

use yii\db\Migration;

/**
 * Class m240710_095104_update_klien_table
 */
class m240710_095104_update_klien_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("ALTER TABLE `klien` ADD `akronim` VARCHAR(5) NULL AFTER `nama_perusahaan`");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('klien', 'akronim');
    }
}
