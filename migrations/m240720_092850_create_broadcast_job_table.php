<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%broadcast_job}}`.
 */
class m240720_092850_create_broadcast_job_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $sql = "CREATE TABLE `broadcast_jobs` (
            `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
            `id_broadcast` INT NOT NULL,
            `destination` VARCHAR(255) NOT NULL,
            `subject` VARCHAR(255) NOT NULL,
            `content` TEXT NOT NULL,
            `status` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '0 = Is Created; 1 = Is Sent; 2 = Is Failed;',
            `send_time` DATETIME NOT NULL,
            `created_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`),
            INDEX `id_broadcast` (`id_broadcast`))
            ENGINE = InnoDB CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci";

        $this->execute($sql);
        $this->execute("ALTER TABLE `broadcast_jobs` ADD CONSTRAINT `fk-broadcast_job-to-broadcast` FOREIGN KEY (`id_broadcast`)
            REFERENCES `broadcast`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%broadcast_jobs}}');
    }
}
