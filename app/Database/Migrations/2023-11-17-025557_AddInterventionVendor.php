<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddInterventionVendor extends Migration
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
            'vendor_name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'contact_person' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'contact_email' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
                'null' => true,
            ],
            'contact_phone' => [
                'type' => 'VARCHAR',
                'constraint' => 15,
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
        $this->forge->createTable('intervention_vendor', true);
    }

    public function down()
    {
        $this->forge->dropTable('intervention_vendor');
    }
}
