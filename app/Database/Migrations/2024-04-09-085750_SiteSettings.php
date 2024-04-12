<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SiteSettings extends Migration
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
            'company_name' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'logo' => [
                'type' => 'VARCHAR',
                'constraint' => 350,
            ],
            'company_address' => [
                'type' => 'TEXT',
            ],
            'primary_color' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
            ],
            'secondary_color' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
            ],
            'background_color' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
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
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('site_settings');
    }

    public function down()
    {
        $this->forge->dropTable('site_settings');
    }
}
