<?php

use yii\db\Migration;
use yii\db\Schema;


class m160215_104413_usergroup extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%group}}', [
            'Id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'parentId' => Schema::TYPE_INTEGER . ' NOT NULL',
            'ip' => Schema::TYPE_STRING . ' NOT NULL',
            'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 10',
            'createdOn' => Schema::TYPE_DATETIME . ' NOT NULL',
            'updatedOn' => Schema::TYPE_DATETIME . ' NOT NULL',
            'createdBy' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updatedBy' => Schema::TYPE_INTEGER . ' NOT NULL',

        ], $tableOptions);

        $this->insert('{{%group}}', [
            'name' => 'Super Admin',
            'parentId' => 0,
            'ip' => '127.0.0.1',
            'status' => 1,
            'createdOn' => date('Y-m-d H:i:s'),
            'updatedOn' => date('Y-m-d H:i:s'),
            'createdBy' => 1,
            'updatedBy' => 1,

        ]);

        $this->createTable('{{%user_group_map}}', [
            'Id' => Schema::TYPE_PK,
            'userId' => Schema::TYPE_INTEGER . ' NOT NULL',
            'groupId' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);

        $this->insert('{{%user_group_map}}', [
            'userId' => 1,
            'groupId' => 1,
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%group}}');
        $this->dropTable('{{%user_group_map}}');
    }
}
