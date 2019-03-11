<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "book".
 *
 * @property int $id
 * @property string $name
 * @property string $publishing_year
 * @property string $ISBN
 * @property string $authorsString
 * @property int $pages_count
 * @property int $image_file_id
 *
 * @property ImageFile $imageFile
 * @property BooksHasAuthors[] $booksHasAuthors
 * @property Author[] $authors
 */
class Book extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'book';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'publishing_year', 'ISBN', 'pages_count'], 'required'],
            [['pages_count', 'image_file_id'], 'integer'],
            [['name', 'publishing_year', 'ISBN'], 'string', 'max' => 255],
            [['ISBN'], 'unique'],
            [['name', 'publishing_year'], 'unique', 'targetAttribute' => ['name', 'publishing_year']],
            [
                ['image_file_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => ImageFile::class,
                'targetAttribute' => ['image_file_id' => 'id']
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'publishing_year' => 'Publishing Year',
            'ISBN' => 'ISBN',
            'pages_count' => 'Pages Count',
            'image_file_id' => 'Image File ID',
            'authorsString' => 'Authors',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImageFile()
    {
        return $this->hasOne(ImageFile::class, ['id' => 'image_file_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooksHasAuthors()
    {
        return $this->hasMany(BooksHasAuthors::class, ['book_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthors()
    {
        return $this->hasMany(Author::class, ['id' => 'author_id'])->via('booksHasAuthors');
    }

    /**
     * @return string
     */
    public function getAuthorsString()
    {
        $authorsString = '';
        foreach ($this->authors as $author) {
            $authorsString .= $author->nameWithInitials . ', ';
        }

        return trim($authorsString, ', ');
    }
}
