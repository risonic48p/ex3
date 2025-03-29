<?php

use yii\db\Migration;

class m250328_235759_short_links_logs extends Migration
{

    /**
     * {@inheritdoc}
     */
    public function safeUp(): bool
    {
        $this->createTable('short_links_logs', [
            'id' => $this->primaryKey(),
            'url_id' => $this->integer(11)->notNull(),
            'user_ip' => $this->string(255)->notNull(),
            'visit_count' => $this->integer(11)->defaultValue(0),
        ]);

        $this->createIndex(
            'idx-links-url_id',
            'short_links_logs',
            'url_id'
        );

        $this->addForeignKey(
            'fk-links_logs-url_id',
            'short_links_logs',
            'url_id',
            'short_links',
            'id',
            'CASCADE'
        );

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown(): bool
    {
        $this->dropForeignKey(
            'fk-links_logs-url_id',
            'short_links_logs'
        );

        $this->dropIndex(
            'idx-links-url_id',
            'short_links_logs'
        );

        $this->dropTable('short_links_logs');

        return true;
    }

}
