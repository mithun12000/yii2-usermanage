<?php

use yii\helpers\Html;
use yii\adminUi\widget\Box;
use yii\adminUi\widget\Row;
use yii\adminUi\widget\Column;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel mithun\parametricfilter\models\SysparamsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Deleted System Params';
$this->params['breadcrumbs'][] = $this->title;


Row::begin();
    Column::begin();
        Box::begin([
            'type' => Box::TYPE_INFO,
            'header' => $this->title,
            'headerIcon' => 'fa fa-gear',
            'headerButtonGroup' => true,
            'headerButton' => Html::a('Back to Parametricfilter', ['create'], ['class' => 'btn btn-success fa fa-long-arrow-left'])
        ]);
				// echo $this->render('_search', ['model' => $searchModel]); 
				
				echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\CheckboxColumn'],

		            'Id',
            'param',
            'table',
            'key',
            'label',
            // 'value',
            // 'ip',
            // 'status',
            // 'createdOn',
            // 'updatedOn',
            // 'createdBy',
            // 'updatedBy',

            [
                'class' => 'yii\grid\ActionColumn',
				'template' =>'{restore} {delete}',
			],
        ],
    ]);
		Box::end();
    Column::end();
Row::end();
?>