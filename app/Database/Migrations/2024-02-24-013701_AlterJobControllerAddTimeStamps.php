<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterJobControllerAddTimeStamps extends Migration
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
        $this->forge->addColumn('job_competencies', $fields);
    }

    public function down()
    {
        //
    }
}
