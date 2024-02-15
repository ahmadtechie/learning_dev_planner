<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class GroupMigration extends Migration
{
    public function up()
    {
        $fields = [
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'group_name' => [
                'type' => 'VARCHAR',
                'constraint' => 355,
            ],
            'division_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'null' => true,
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
        ];
        $this->forge->addField($fields);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('division_id', 'division', 'id', '', 'CASCADE');
        $this->forge->createTable('group', true);
    }

    public function down()
    {
        $this->forge->dropTable('group');
    }
}
