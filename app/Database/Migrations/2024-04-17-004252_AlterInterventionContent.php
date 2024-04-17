<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterInterventionContent extends Migration
{
    public function up()
    {
        $fields = [
            'sub_topics' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'objectives' => [
                'type' => 'TEXT',
                'null' => true,
            ],
        ];
        $this->forge->addColumn('intervention_content', $fields);
    }

    public function down()
    {
        //
    }
}
