<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UnitMigration extends Migration
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
            'unit_name' => [
                'type' => 'VARCHAR',
                'constraint' => 355,
            ],
            'department_id' => [
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
        $this->forge->addForeignKey('department_id', 'department', 'id', '', 'CASCADE');
        $this->forge->createTable('unit', true);
    }

    public function down()
    {
        $this->forge->dropTable('unit');
    }
}
