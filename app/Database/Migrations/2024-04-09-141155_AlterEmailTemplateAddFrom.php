<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterEmailTemplateAddFrom extends Migration
{
    public function up()
    {
        $fields = [
            'email_from' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
        ];
        $this->forge->addColumn('email_template', $fields);
    }

    public function down()
    {
        //
    }
}
