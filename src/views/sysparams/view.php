<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ListView;
use yii\grid\GridView;
use yii\adminUi\widget\Box;
use yii\adminUi\widget\Row;
use yii\adminUi\widget\Column;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model mithun\parametricfilter\models\SystemParams */

$this->title = $model->Id;
$this->params['breadcrumbs'][] = ['label' => 'System Params', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


Row::begin();
    Column::begin();
        Box::begin([
            'type' => Box::TYPE_INFO,
            'header' => $this->title,
            'headerIcon' => 'fa fa-gear',
            'headerButtonGroup' => true,
            'headerButton' => Html::a('Update', ['update', 'id' => $model->Id], ['class' => 'btn btn-primary'])
                            .Html::a('Delete', ['delete', 'id' => $model->Id], [
								'class' => 'btn btn-danger',
								'data' => [
									'confirm' => 'Are you sure you want to delete this item?',
									'method' => 'post',
								],
							])
        ]);
		
		echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Id',
            'param',
            'table',
            'key',
            'label',
            'value',
            'ip',
            'status',
            'createdOn',
            'updatedOn',
            'createdBy',
            'updatedBy',
        ],
    ]);
        Box::end();
    Column::end();
Row::end();
?>