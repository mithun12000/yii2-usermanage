<?php
namespace mithun\usermanage\component;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;

class UserActiveRecord extends \yii\db\ActiveRecord
{
    /**
     *
     * @return string
     */
    public function ClassSortNeme() {
        return join('', array_slice(explode('\\', $this->className()), -1));
    }

    public function behaviors()
    {
        return array(
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['createdOn', 'updatedOn'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'updatedOn',
                ],
                'value' => new Expression('NOW()'),
            ],
            'user' => [
                'class' => 'yii\behaviors\BlameableBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['createdBy', 'updatedBy'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'updatedBy',
                ],
            ],
            'ip' => [
                'class' => 'yii\behaviors\AttributeBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'ip',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'ip',
                ],
                'value' => function($event){
                    if(method_exists(Yii::$app->request, 'getUserIP')){
                        return Yii::$app->request->getUserIP();
                    }else{
                        return '127.0.0.1';
                    }

                }
            ],
            /*
            'audit' => [
               'class' => 'common\sammaye\LoggableBehavior',

           ],

             *
             */

        );
    }
}
