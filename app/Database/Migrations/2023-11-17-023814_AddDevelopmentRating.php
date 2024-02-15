<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddDevelopmentRating extends Migration
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
            'employee_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true
            ],
            'competency_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true
            ],
            'self_rating' => [
                'type' => 'INT',
                'constraint' => 2,
                'default' => 1,
                'unsigned' => true
            ],
            'line_manager_rating' => [
                'type' => 'INT',
                'constraint' => 2,
                'default' => 1,
                'unsigned' => true
            ],
            'cycle_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true
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
        $this->forge->addForeignKey('employee_id', 'employee', 'id', '', 'CASCADE');
        $this->forge->addForeignKey('competency_id', 'competency', 'id', '', 'CASCADE');
        $this->forge->addForeignKey('cycle_id', 'development_cycle', 'id', '', 'CASCADE');
        $this->forge->createTable('development_rating', true);
    }

    public function down()
    {
        $this->forge->dropTable('development_rating');
    }
}
