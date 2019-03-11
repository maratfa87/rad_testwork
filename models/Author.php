<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "author".
 *
 * @property int $id
 * @property string $name
 * @property string $surname
 * @property string $patronymic
 * @property string $nameWithInitials
 *
 * @property BooksHasAuthors[] $booksHasAuthors
 * @property Book[] $books
 */
class Author extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'author';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'surname', 'patronymic'], 'required'],
            [['name', 'surname', 'patronymic'], 'string', 'max' => 255],
            [['name', 'surname', 'patronymic'], 'unique', 'targetAttribute' => ['name', 'surname', 'patronymic']]
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
            'surname' => 'Surname',
            'patronymic' => 'Patronymic',
            'nameWithInitials' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooksHasAuthors()
    {
        return $this->hasMany(BooksHasAuthors::class, ['author_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooks()
    {
        return $this->hasMany(Book::class, ['id' => 'book_id'])->via('booksHasAuthors');
    }

    /**
     * @return string
     */
    public function getNameWithInitials()
    {
        return $this->surname . ' '
            . substr($this->name, 0, 1) . '.'
            . substr($this->patronymic, 0, 1) . '.';
    }

    public static function getAllAuthorsArray()
    {
        $authors = self::find()
            ->select([
                'id',
                'name',
                'surname',
                'patronymic',
            ])
            ->all();

        $authorsArray = [];
        foreach ($authors as $author) {
            $authorsArray[$author->id] = $author->name . ' ' . $author->patronymic . ' ' . $author->surname;
        }

        return $authorsArray;
    }
}
