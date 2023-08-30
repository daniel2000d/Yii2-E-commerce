<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%adress}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 */
class m230830_111115_create_adress_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%adress}}', [
            'user_id'=>$this->primaryKey(),
            'adress'=>$this->string(255),
            'city'=>$this->string(255),
            'state'=>$this->string(255),
            'country'=>$this->string(45),
            'zipcode'=>$this->string(255),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-adress-user_id}}',
            '{{%adress}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-adress-user_id}}',
            '{{%adress}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-adress-user_id}}',
            '{{%adress}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-adress-user_id}}',
            '{{%adress}}'
        );

        $this->dropTable('{{%adress}}');
    }
}
