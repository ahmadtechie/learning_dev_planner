<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterADP extends Migration
{
    public function up()
    {
        $fields = [
            'group_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
        ];
        $this->forge->addColumn('annual_development_plan', $fields);
        $this->forge->addForeignKey('group_id', 'group', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        //
    }
}
