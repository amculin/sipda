<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%comission}}`.
 */
class m240930_074416_create_comission_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $sql = "CREATE TABLE `comission` (
            `id` mediumint unsigned NOT NULL AUTO_INCREMENT,
            `sales_id` int NOT NULL,
            `month` tinyint unsigned NOT NULL,
            `year` year NOT NULL,
            `comission` int unsigned NOT NULL DEFAULT '0',
            `total_sale` int unsigned NOT NULL DEFAULT '0',
            `is_achieved` tinyint unsigned NOT NULL DEFAULT '0' COMMENT '0 = Is Not Achieved; 1 = Is Achieved;',
            `is_paid` tinyint unsigned NOT NULL DEFAULT '0' COMMENT '0 = Not Paid Yet; 1 = Is  Already Paid;',
            `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_date` datetime DEFAULT NULL,
            PRIMARY KEY (`id`),
            INDEX `sales_id` (`sales_id`))
            ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

        $this->execute($sql);
        $this->execute("ALTER TABLE `comission` ADD CONSTRAINT `fk-comission-to-user` FOREIGN KEY (`sales_id`)
            REFERENCES `user`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%comission}}');
    }
}
