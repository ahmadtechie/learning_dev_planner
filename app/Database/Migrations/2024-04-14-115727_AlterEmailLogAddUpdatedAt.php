<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterEmailLogAddUpdatedAt extends Migration
{
    public function up()
    {
        $fields = [
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
        ];
        $this->forge->addColumn('email_logs', $fields);
    }

    public function down()
    {
        //
    }
}
