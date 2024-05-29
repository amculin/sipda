<?php

use yii\db\Migration;

/**
 * Class m240529_022457_update_plan_table
 */
class m240529_022457_update_plan_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("ALTER TABLE `plan` ADD `id_unit` SMALLINT NOT NULL AFTER `id`");
        $this->execute("ALTER TABLE `plan` ADD INDEX(`id_unit`)");
        $this->execute("ALTER TABLE `plan` ADD CONSTRAINT `fk-plan-to-unit` FOREIGN KEY (`id_unit`)
            REFERENCES `unit`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT");
        $this->execute("ALTER TABLE `plan` ADD `data` JSON NULL AFTER `bulan`");
        $this->execute("ALTER TABLE `plan` CHANGE `tahun` `tahun` YEAR NOT NULL");
        $this->dropColumn('plan', 'bulan');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->execute("ALTER TABLE `plan` DROP FOREIGN KEY `fk-plan-to-unit`");
        $this->dropColumn('plan', 'id_unit');
        $this->execute("ALTER TABLE `plan` ADD `bulan` TINYINT UNSIGNED NOT NULL AFTER `tahun`");
        $this->execute("ALTER TABLE `plan` CHANGE `tahun` `tahun` TINYINT UNSIGNED NOT NULL");
        $this->dropColumn('plan', 'data');
    }
}
