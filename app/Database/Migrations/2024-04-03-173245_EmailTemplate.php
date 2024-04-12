<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EmailTemplate extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'email_type' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'email_subject' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
            ],
            'email_body' => [
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
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('email_template');
    }

    public function down()
    {
        $this->forge->dropTable('email_template');
    }
}
