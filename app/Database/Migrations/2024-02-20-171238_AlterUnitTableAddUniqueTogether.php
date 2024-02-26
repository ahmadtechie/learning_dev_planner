<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterUnitTableAddUniqueTogether extends Migration
{
    public function up()
    {
        $this->forge->addUniqueKey(['unit_name', 'department_id']);
    }

    public function down()
    {
        //
    }
}
