<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterInterventionVendor extends Migration
{
    public function up()
    {
        $fields = [
            'intervention_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
        ];
        $this->forge->addColumn('intervention_vendor', $fields);
        $this->forge->addForeignKey('intervention_id', 'learning_intervention', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        //
    }
}
