<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterEmployeeInterventionAddCycleId extends Migration
{
    public function up()
    {
        $fields = [
            'cycle_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
        ];
        $this->forge->addColumn('employee_interventions', $fields);
        $this->forge->addForeignKey('cycle_id', 'development_cycle', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        //
    }
}
