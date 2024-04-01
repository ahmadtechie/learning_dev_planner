<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ModifyEmployee extends Migration
{
    public function up()
    {
        $fields = [
            'is_active' => [
                'type' => 'BOOLEAN',
                'default' => true,
            ],
        ];
        $this->forge->addColumn('employee', $fields);
    }

    public function down()
    {
        //
    }
}
