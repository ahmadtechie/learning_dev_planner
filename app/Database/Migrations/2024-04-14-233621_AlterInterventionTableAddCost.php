<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterInterventionTableAddCost extends Migration
{
    public function up()
    {
        $fields = [
            'cost' => [
                'type' => 'FLOAT',
                'default' => 0.0,
            ],
        ];
        $this->forge->addColumn('learning_intervention', $fields);
    }

    public function down()
    {
        //
    }
}
