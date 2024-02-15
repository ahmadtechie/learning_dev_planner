<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class AddDevelopmentCycle extends Migration
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
            'max_competencies' => [
                'type' => 'INT',
                'constraint' => 5,
                'default' => 0,
                'unsigned' => true,
            ],
            'cycle_year' => [
                'type' => 'INT',
                'constraint' => 4,
                'unsigned' => true,
            ],
            'start_month' => [
                'type' => 'TINYINT',
                'constraint' => 4,
                'default' => 1,
                'unsigned' => true,
            ],
            'end_month' => [
                'type' => 'TINYINT',
                'constraint' => 4,
                'default' => 1,
                'unsigned' => true,
            ],
            'descriptor_text' => [
                'type' => 'TEXT',
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
        $this->forge->createTable('development_cycle', true);
    }

    public function down()
    {
        $this->forge->dropTable('development_cycle');
    }
}
