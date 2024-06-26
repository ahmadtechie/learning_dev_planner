<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterEmployeeInterventionsMapping extends Migration
{
    public function up()
    {
        $fields = [
            'class_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
        ];
        $this->forge->addColumn('employee_interventions', $fields);
        $this->forge->addForeignKey('class_id', 'intervention_class', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        //
    }
}
