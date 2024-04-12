<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterDevCycleTable extends Migration
{
    public function up()
    {
        $fields = [
            'is_active' => [
                'type' => 'BOOLEAN',
                'default' => true,
            ],
        ];
        $this->forge->addColumn('development_cycle', $fields);
    }

    public function down()
    {
        //
    }
}
