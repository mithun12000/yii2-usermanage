<?php

namespace mithun\usermanage\models;

use Yii;
use mithun\usermanage\component\UserActiveRecord;

/**
 * This is the model class for table "{{%system_params}}".
 *
 * @property integer $Id
 * @property string $param
 * @property string $table
 * @property string $key
 * @property string $label
 * @property string $value
 * @property string $ip
 * @property integer $status
 * @property string $createdOn
 * @property string $updatedOn
 * @property integer $createdBy
 * @property integer $updatedBy
 */
class SystemParams extends UserActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%system_params}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['param', 'table', 'key', 'label', 'value', 'ip', 'createdOn', 'updatedOn', 'createdBy', 'updatedBy'], 'required'],
            [['status', 'createdBy', 'updatedBy'], 'integer'],
            [['createdOn', 'updatedOn'], 'safe'],
            [['param', 'table', 'key', 'label', 'value'], 'string', 'max' => 50],
            [['ip'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'param' => 'Param',
            'table' => 'Table',
            'key' => 'Key',
            'label' => 'Label',
            'value' => 'Value',
            'ip' => 'Ip',
            'status' => 'Status',
            'createdOn' => 'Created On',
            'updatedOn' => 'Updated On',
            'createdBy' => 'Created By',
            'updatedBy' => 'Updated By',
        ];
    }
}
