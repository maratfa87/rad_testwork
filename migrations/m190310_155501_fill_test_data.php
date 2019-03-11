<?php

use yii\db\Migration;

/**
 * Class m190310_155501_fill_test_data
 */
class m190310_155501_fill_test_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->insert('author', [
            'id' => '1',
            'name' => 'William',
            'surname' => 'Gibson',
            'patronymic' => 'Ford',
        ]);
        $this->insert('author', [
            'id' => '2',
            'name' => 'Michael',
            'surname' => 'Sterling',
            'patronymic' => 'Bruce',
        ]);
        $this->insert('author', [
            'id' => '3',
            'name' => 'Neal',
            'surname' => 'Stephenson',
            'patronymic' => 'Town',
        ]);

        $this->insert('image_file', ['id' => '1', 'path' => '/images/books/TheDifferenceEngine.jpg']);
        $this->insert('image_file', ['id' => '2', 'path' => '/images/books/Neuromancer.jpg']);
        $this->insert('image_file', ['id' => '3', 'path' => '/images/books/Schismatrix.jpg']);
        $this->insert('image_file', ['id' => '4', 'path' => '/images/books/Snowcrash.jpg']);

        $this->insert('book', [
            'id' => '1',
            'name' => 'The Difference Engine',
            'publishing_year' => '1990',
            'ISBN' => '0-575-04762-3',
            'pages_count' => '544',
            'image_file_id' => '1',
        ]);
        $this->insert('book', [
            'id' => '2',
            'name' => 'Neuromancer',
            'publishing_year' => '1984',
            'ISBN' => '0-441-56956-0',
            'pages_count' => '480',
            'image_file_id' => '2',
        ]);
        $this->insert('book', [
            'id' => '3',
            'name' => 'Schismatrix',
            'publishing_year' => '1985',
            'ISBN' => '0-87795-645-6',
            'pages_count' => '288',
            'image_file_id' => '3',
        ]);
        $this->insert('book', [
            'id' => '4',
            'name' => 'Snow Crash',
            'publishing_year' => '1992',
            'ISBN' => '5-17-017528-0',
            'pages_count' => '448',
            'image_file_id' => '4',
        ]);

        $this->insert('books_has_authors', ['book_id' => '1', 'author_id' => '1']);
        $this->insert('books_has_authors', ['book_id' => '1', 'author_id' => '2']);
        $this->insert('books_has_authors', ['book_id' => '2', 'author_id' => '1']);
        $this->insert('books_has_authors', ['book_id' => '3', 'author_id' => '2']);
        $this->insert('books_has_authors', ['book_id' => '4', 'author_id' => '3']);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->execute('SET FOREIGN_KEY_CHECKS = 0;');
        $this->truncateTable('author');
        $this->truncateTable('image_file');
        $this->truncateTable('book');
        $this->truncateTable('books_has_authors');
        $this->execute('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
