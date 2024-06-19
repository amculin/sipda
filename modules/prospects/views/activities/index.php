<?php

use app\modules\prospects\models\Aktivitas;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\modules\prospects\models\AktivitasSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Aktivitas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aktivitas-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Aktivitas', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_lead',
            'id_tahapan',
            'tanggal',
            'lokasi',
            //'aktivitas',
            //'progres',
            //'id_status',
            //'is_deleted',
            //'timestamp',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Aktivitas $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
