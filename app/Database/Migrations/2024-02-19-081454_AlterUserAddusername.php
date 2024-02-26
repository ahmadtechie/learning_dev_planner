<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterUserAddusername extends Migration
{
    public function up()
    {
        $fields = [
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
        ];
        $this->forge->addColumn('user', $fields);
    }

    public function down()
    {
        //
    }
}
