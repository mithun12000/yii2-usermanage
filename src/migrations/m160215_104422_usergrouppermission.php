<?php

use yii\db\Migration;
use yii\db\Schema;


class m160215_104422_usergrouppermission extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%permissions}}', [
            'Id' => Schema::TYPE_PK,
            'userId' => Schema::TYPE_INTEGER,
            'groupId' => Schema::TYPE_INTEGER,
            'module' => Schema::TYPE_STRING . '(50) NOT NULL',
            'controller' => Schema::TYPE_STRING . '(50) NOT NULL',
            'action' => Schema::TYPE_STRING . '(50) NOT NULL',
            'type' => Schema::TYPE_SMALLINT . ' NOT NULL',

            'ip' => Schema::TYPE_STRING . ' NOT NULL',
            'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 10',
            'createdOn' => Schema::TYPE_DATETIME . ' NOT NULL',
            'updatedOn' => Schema::TYPE_DATETIME . ' NOT NULL',
            'createdBy' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updatedBy' => Schema::TYPE_INTEGER . ' NOT NULL',

        ], $tableOptions);

        $this->insert('{{%permissions}}', [
            'groupId' => 1,
            'module' => '*',
            'controller' => '*',
            'action' => '*',
            'type' => 1,
            'ip' => '127.0.0.1',
            'status' => 1,
            'createdOn' => date('Y-m-d H:i:s'),
            'updatedOn' => date('Y-m-d H:i:s'),
            'createdBy' => 1,
            'updatedBy' => 1,

        ]);
    }

    public function down()
    {
        $this->dropTable('{{%permissions}}');
    }
}
