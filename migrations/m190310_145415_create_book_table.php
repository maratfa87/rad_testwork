<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%book}}`.
 */
class m190310_145415_create_book_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%book}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'publishing_year' => $this->string(255)->notNull(),
            'ISBN' => $this->string(255)->unique()->notNull(),
            'pages_count' => $this->integer(11)->notNull(),
            'image_file_id' => $this->integer(11)->null(),
        ], $tableOptions);

        $this->addForeignKey(
            'fk-book-image_file',
            '{{%book}}',
            'image_file_id',
            '{{%image_file}}',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropForeignKey('fk-book-image_file', '{{%book}}');
        $this->dropTable('{{%book}}');
    }
}
