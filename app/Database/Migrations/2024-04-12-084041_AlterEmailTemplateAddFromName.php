<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterEmailTemplateAddFromName extends Migration
{
    public function up()
    {
        $fields = [
            'email_from_name' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
            ],
        ];
        $this->forge->addColumn('email_template', $fields);
    }

    public function down()
    {
        //
    }
}
