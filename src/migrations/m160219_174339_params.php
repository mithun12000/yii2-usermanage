<?php

use yii\db\Migration;
use yii\db\Schema;

class m160219_174339_params extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%system_params}}', [
            'Id' => Schema::TYPE_PK,
            'param' => Schema::TYPE_STRING . '(50) NOT NULL',
            'table' => Schema::TYPE_STRING . '(50) NOT NULL',
            'key' => Schema::TYPE_STRING . '(50) NOT NULL',
            'label' => Schema::TYPE_STRING . '(50) NOT NULL',
            'value' => Schema::TYPE_STRING . '(50) NOT NULL',

            'ip' => Schema::TYPE_STRING . ' NOT NULL',
            'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 10',
            'createdOn' => Schema::TYPE_DATETIME . ' NOT NULL',
            'updatedOn' => Schema::TYPE_DATETIME . ' NOT NULL',
            'createdBy' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updatedBy' => Schema::TYPE_INTEGER . ' NOT NULL',

        ], $tableOptions);

        $this->createTable('{{%user_group_params}}', [
            'Id' => Schema::TYPE_PK,
            'userId' => Schema::TYPE_INTEGER,
            'groupId' => Schema::TYPE_INTEGER,
            'paramId' => Schema::TYPE_STRING . '(50) NOT NULL',
            'value' => Schema::TYPE_STRING . '(50) NOT NULL',
            'type' => Schema::TYPE_SMALLINT . ' NOT NULL',

            'ip' => Schema::TYPE_STRING . ' NOT NULL',
            'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 10',
            'createdOn' => Schema::TYPE_DATETIME . ' NOT NULL',
            'updatedOn' => Schema::TYPE_DATETIME . ' NOT NULL',
            'createdBy' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updatedBy' => Schema::TYPE_INTEGER . ' NOT NULL',

        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%system_params}}');

        $this->dropTable('{{%user_group_params}}');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
