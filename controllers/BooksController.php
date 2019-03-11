<?php

namespace app\controllers;

use Yii;
use app\models\Book;
use app\models\BooksSearch;
use app\models\BooksHasAuthors;
use app\utilities\SubModelController;
use yii\web\UploadedFile;
use app\models\FileUploadModel;

/**
 * BooksController implements the CRUD actions for Book model.
 */
class BooksController extends SubModelController
{
    /** @var string */
    public $modelClass = Book::class;
    /** @var string */
    public $searchModelClass  = BooksSearch::class;

    public function actionCreate()
    {
        $model = new Book();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $uploadModel = new FileUploadModel();
            $uploadModel->imageFile = UploadedFile::getInstanceByName('imageFile');
            if ($uploadModel->upload()) {
                $model->image_file_id = $uploadModel->getInsertedImageId();
                $model->save();
            }

            foreach (Yii::$app->request->post('Book')['authors'] as $newAuthorId) {
                $author = new BooksHasAuthors();
                $author->book_id = $model->id;
                $author->author_id = $newAuthorId;
                $author->save();
            }

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $uploadModel = new FileUploadModel();
            $uploadModel->imageFile = UploadedFile::getInstanceByName('imageFile');
            if ($uploadModel->upload()) {
                $model->image_file_id = $uploadModel->getInsertedImageId();
                $model->save();
            }

            $oldAuthors = BooksHasAuthors::find()->where(['book_id' => $model->id])->all();
            foreach ($oldAuthors as $oldAuthor) {
                $oldAuthor->delete();
            }

            foreach (Yii::$app->request->post('Book')['authors'] as $newAuthorId) {
                $author = new BooksHasAuthors();
                $author->book_id = $model->id;
                $author->author_id = $newAuthorId;
                $author->save();
            }

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $bookHasAuthors = BooksHasAuthors::find()->where(['book_id' => $id])->all();
        foreach ($bookHasAuthors as $bookHasAuthor) {
            $bookHasAuthor->delete();
        }

        parent::actionDelete($id);
    }
}
