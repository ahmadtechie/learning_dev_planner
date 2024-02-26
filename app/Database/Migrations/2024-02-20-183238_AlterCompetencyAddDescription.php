<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterCompetencyAddDescription extends Migration
{
    public function up()
    {
        $fields = [
            'description' => [
                'type' => 'TEXT',
            ],
        ];
        $this->forge->addColumn('competency', $fields);
    }

    public function down()
    {
        //
    }
}
