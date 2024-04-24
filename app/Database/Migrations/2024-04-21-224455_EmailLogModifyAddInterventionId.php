<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EmailLogModifyAddInterventionId extends Migration
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
        $this->forge->addColumn('email_logs', $fields);
        $this->forge->addForeignKey('intervention_id', 'learning_intervention', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        //
    }
}
