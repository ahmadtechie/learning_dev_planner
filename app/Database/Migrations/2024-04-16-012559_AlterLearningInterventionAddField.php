<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterLearningInterventionAddField extends Migration
{
    public function up()
    {
        $fields = [
            'competency_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
        ];
        $this->forge->addColumn('learning_intervention', $fields);
        $this->forge->addForeignKey('competency_id', 'competency', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        //
    }
}
