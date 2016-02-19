<?php

use yii\db\Schema;

class m130524_201442_init extends \yii\db\Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        echo " Creating User Table \n";

        $this->createTable('{{%user}}', [
            'Id' => Schema::TYPE_PK,
            'username' => Schema::TYPE_STRING . ' NOT NULL',
            'auth_key' => Schema::TYPE_STRING . '(32) NOT NULL',
            'password_hash' => Schema::TYPE_STRING . ' NOT NULL',
            'password_reset_token' => Schema::TYPE_STRING,
            'email' => Schema::TYPE_STRING . ' NOT NULL',
            'firstname' => Schema::TYPE_STRING . ' NOT NULL',
            'lastname' => Schema::TYPE_STRING . ' NOT NULL',
            'groupId' => Schema::TYPE_INTEGER,
            'reportTo' => Schema::TYPE_INTEGER,
            'reportUserType' => Schema::TYPE_INTEGER,
            'phone' => Schema::TYPE_STRING . ' NOT NULL',
            'ip' => Schema::TYPE_STRING . ' NOT NULL',
            'role' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 10',
            'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 10',
            'createdOn' => Schema::TYPE_DATETIME . ' NOT NULL',
            'updatedOn' => Schema::TYPE_DATETIME . ' NOT NULL',
            'createdBy' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updatedBy' => Schema::TYPE_INTEGER . ' NOT NULL',

        ], $tableOptions);

        echo " Adding User admin \n";

        $this->insert('{{%user}}', [
            'username' => 'admin',
            'auth_key' => 'RzSjv1rF4Uel6lW6q1SVEJk6SQel7YOC',
            'password_hash' => '$2y$13$D0wl2e1lw5ym/WJ3JjkDw.2tm4PJih.uJBSq1zXuhzd.Wa7hhNn7e',
            'email' => 'admin@timeinc.com',
            'firstname' => 'Super',
            'lastname' => 'Admin',
            'phone' => 8527580960,
            'ip' => '127.0.0.1',
            'role' => 1,
            'status' => 1,
            'createdOn' => date('Y-m-d H:i:s'),
            'updatedOn' => date('Y-m-d H:i:s'),
            'createdBy' => 1,
            'updatedBy' => 1,

        ]);
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}
