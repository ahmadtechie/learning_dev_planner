<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterLearningInterventionAddInterventionName extends Migration
{
    public function up()
    {
        $this->forge->dropColumn('learning_intervention', 'intervention_name');
        $fields = [
            'intervention_name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
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
