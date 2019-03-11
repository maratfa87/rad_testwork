<?php

use yii\db\Migration;

/**
 * Class m190310_145436_create_books_has_authors_tabl
 */
class m190310_145436_create_books_has_authors_table extends Migration
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

        $this->createTable('{{%books_has_authors}}', [
            'id' => $this->primaryKey(),
            'book_id' => $this->integer(11)->notNull(),
            'author_id' => $this->integer(11)->notNull(),
        ], $tableOptions);

        $this->addForeignKey(
            'fk-books_has_authors-book',
            '{{%books_has_authors}}',
            'book_id',
            '{{%book}}',
            'id'
        );

        $this->addForeignKey(
            'fk-books_has_authors-author',
            '{{%books_has_authors}}',
            'author_id',
            '{{%author}}',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropForeignKey('fk-books_has_authors-author', '{{%books_has_authors}}');
        $this->dropForeignKey('fk-books_has_authors-book', '{{%books_has_authors}}');
        $this->dropTable('{{%books_has_authors}}');
    }
}
