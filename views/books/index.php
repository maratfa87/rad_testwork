<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BooksSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Books';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Create Book', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => 'Image',
                'format' => 'raw',
                'value' => function($data) {
                    if (!is_null($data->imageFile)) {
                        return Html::img(Url::toRoute($data->imageFile->path),[
                            'alt' => $data->name,
                            'style' => 'width:50px;'
                        ]);
                    }
                },
            ],
            'name',
            'publishing_year',
            'ISBN',
            'pages_count',
            'authorsString',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
