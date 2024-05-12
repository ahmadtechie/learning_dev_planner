<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterADPAddJobId extends Migration
{
    public function up()
    {
        $fields = [
            'job_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
        ];
        $this->forge->addColumn('annual_development_plan', $fields);
        $this->forge->addForeignKey('job_id', 'job', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        //
    }
}
