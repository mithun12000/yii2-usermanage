<?php

use yii\helpers\Html;
use yii\adminUi\widget\Box;
use yii\adminUi\widget\Row;
use yii\adminUi\widget\Column;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel mithun\parametricfilter\models\SysparamsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'System Params';
$this->params['breadcrumbs'][] = $this->title;


Row::begin();
    Column::begin();
        Box::begin([
            'type' => Box::TYPE_INFO,
            'header' => $this->title,
            'headerIcon' => 'fa fa-gear',
            'headerButtonGroup' => true,
            'headerButton' => Html::a('Create System Params', ['create'], ['class' => 'btn btn-success'])
                            .Html::a('<i class="fa fa-trash-o fa-lg"></i>&nbsp; Trash', ['sysparams-trash/index'], ['class' => 'btn btn-default'])
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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);

		Box::end();
    Column::end();
Row::end();
?>