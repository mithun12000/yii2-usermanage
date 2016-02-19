<?php
namespace mithun\usermanage\component;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\base\ModelEvent;
use yii\base\Event;

class UserActiveRecord extends \yii\db\ActiveRecord
{
    /**
     * @event ModelEvent an event that is triggered before soft deleting a record.
     * You may set [[ModelEvent::isValid]] to be false to stop the insertion.
     */
    const EVENT_BEFORE_SOFTDELETE = 'beforeSoftDelete';
    /**
     * @event Event an event that is triggered after a soft deleting
     */
    const EVENT_AFTER_SOFTDELETE = 'afterSoftDelete';
    /**
     * @event ModelEvent an event that is triggered before soft deleting a record.
     * You may set [[ModelEvent::isValid]] to be false to stop the insertion.
     */
    const EVENT_BEFORE_RESTORE = 'beforeRestore';
    /**
     * @event Event an event that is triggered after a soft deleting
     */
    const EVENT_AFTER_RESTORE = 'afterRestore';

    const STATUS_DELETE = 0;
    const STATUS_PUBLISH = 1;

    public $statusnames = [
        self::STATUS_DELETE         => 'Deleted',
        self::STATUS_PUBLISH        => 'Active',
        //self::STATUS_DRAFT          => 'Draft',
    ];

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

    public function beforeSoftDelete() {
        $event = new ModelEvent;
        \yii::trace('event generated:'.__METHOD__,'event');
        $this->trigger(self::EVENT_BEFORE_SOFTDELETE, $event);

        return $event->isValid;
    }

    public function afterSoftDelete() {
        \yii::trace('event generated:'.__METHOD__,'event');
        $this->trigger(self::EVENT_AFTER_SOFTDELETE);
    }

    public function softdelete() {
        if (!$this->beforeSoftDelete()) {
            return false;
        }

        $this->status = self::STATUS_DELETE;
        \yii::trace('set Status::'.$this->statusnames[$this->status], 'setStatus');

        $isSave = parent::save(false);
        if($isSave){
            $this->afterSoftDelete();
        }
        return $isSave;
    }

    public function beforeRestore() {
        $event = new ModelEvent;
        \yii::trace('event generated:'.__METHOD__,'event');
        $this->trigger(self::EVENT_BEFORE_RESTORE, $event);

        return $event->isValid;
    }

    public function afterRestore() {
        \yii::trace('event generated:'.__METHOD__,'event');
        $this->trigger(self::EVENT_AFTER_RESTORE);
    }

    public function restore() {
        if (!$this->beforeRestore()) {
            return false;
        }

        $this->status = self::STATUS_PUBLISH;
        \yii::trace('set Status::'.$this->statusnames[$this->status], 'setStatus');

        $isSave = parent::save(false);
        if($isSave){
            $this->afterRestore();
        }
        return $isSave;
    }
}
