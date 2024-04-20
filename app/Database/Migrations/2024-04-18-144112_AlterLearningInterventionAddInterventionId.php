<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterLearningInterventionAddInterventionId extends Migration
{
    public function up()
    {
        $fields = [
            'intervention_id' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
            ],
        ];
        $this->forge->addColumn('learning_intervention', $fields);
    }

    public function down()
    {
        //
    }
}
