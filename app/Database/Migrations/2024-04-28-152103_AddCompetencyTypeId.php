<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCompetencyTypeId extends Migration
{
    public function up()
    {
        $fields = [
            'competency_type_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
        ];
        $this->forge->addColumn('competency', $fields);
        $this->forge->addForeignKey('competency_type_id', 'competency_type', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        //
    }
}
