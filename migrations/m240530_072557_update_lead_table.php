<?php

use yii\db\Migration;

/**
 * Class m240530_072557_update_lead_table
 */
class m240530_072557_update_lead_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("ALTER TABLE `lead` ADD `id_unit` SMALLINT NOT NULL AFTER `id`");
        $this->execute("ALTER TABLE `lead` ADD INDEX(`id_unit`)");
        $this->execute("ALTER TABLE `lead` ADD CONSTRAINT `fk-lead-to-unit` FOREIGN KEY (`id_unit`)
            REFERENCES `unit`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT");
        $this->execute("ALTER TABLE `lead` ADD `year` YEAR NOT NULL AFTER `timestamp`");
        $this->execute("ALTER TABLE `lead` ADD INDEX(`year`)");
        $this->execute("ALTER TABLE `lead` ADD `counter` SMALLINT UNSIGNED NOT NULL AFTER `year`");

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->execute("ALTER TABLE `lead` DROP FOREIGN KEY `fk-lead-to-unit`");
        $this->dropColumn('lead', 'id_unit');
        $this->dropColumn('lead', 'year');
        $this->dropColumn('lead', 'counter');
    }
}
