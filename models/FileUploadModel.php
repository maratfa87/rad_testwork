<?php

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class FileUploadModel extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    /**
     * @var ImageFile
     */
    private $imageRecord;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [
                ['imageFile'],
                'file',
                'skipOnEmpty' => false,
                'extensions' => 'jpeg, jpg, png',
                'mimeTypes' => 'image/jpeg, image/png',
            ],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $path = dirname(__DIR__) . '/web/images/books/';
            $this->imageFile->saveAs($path . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            $this->insert();

            return true;
        }
        return false;
    }

    public function getInsertedImageId()
    {
        return $this->imageRecord->id;
    }

    private function insert()
    {
        $this->imageRecord = new ImageFile();
        $this->imageRecord->path = '/images/books/' . $this->imageFile->baseName . '.' . $this->imageFile->extension;
        $this->imageRecord->save();
    }
}
