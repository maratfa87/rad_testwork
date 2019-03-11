<?php

namespace app\controllers;

use app\models\Author;
use app\models\AuthorsSearch;
use app\utilities\SubModelController;

/**
 * AuthorsController implements the CRUD actions for Author model.
 */
class AuthorsController extends SubModelController
{
    /** @var string */
    public $modelClass = Author::class;
    /** @var string */
    public $searchModelClass  = AuthorsSearch::class;

    public function actionDelete($id)
    {
        if (!empty($this->findModel($id)->books)) {
            return $this->redirect(['index']);
        }

        parent::actionDelete($id);
    }
}
