<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EmailLogsTableAlter extends Migration
{
    public function up()
    {
        $fields = [
            'type' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
        ];
        $this->forge->addColumn('email_logs', $fields);
    }

    public function down()
    {
        //
    }
}
