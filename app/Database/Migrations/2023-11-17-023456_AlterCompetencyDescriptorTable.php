<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterCompetencyDescriptorTable extends Migration
{
    public function up()
    {
        $fields = [
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
        $this->forge->addColumn('competency_descriptor', $fields);
    }

    public function down()
    {
        //
    }
}
