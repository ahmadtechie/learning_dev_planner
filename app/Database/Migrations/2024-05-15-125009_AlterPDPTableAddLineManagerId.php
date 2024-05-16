<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterPDPTableAddLineManagerId extends Migration
{
    public function up()
    {
        $fields = [
            'line_manager_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
        ];
        $this->forge->addColumn('personal_development_plan', $fields);
        $this->forge->addForeignKey('line_manager_id', 'employee', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        //
    }
}
