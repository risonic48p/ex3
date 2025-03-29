<?php

use yii\db\Migration;

class m250327_171419_short_links extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp(): bool
    {
        $this->createTable('short_links', [
            'id' => $this->primaryKey(),
            'url' => $this->string(255)->notNull(),
            'hash' => $this->string(10)->unique(),
        ]);

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown(): bool
    {
        $this->dropTable('short_links');

        return true;
    }

}
