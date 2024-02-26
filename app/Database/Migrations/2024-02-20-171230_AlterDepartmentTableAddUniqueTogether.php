<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterDepartmentTableAddUniqueTogether extends Migration
{
    public function up()
    {
        $this->forge->addUniqueKey(['group_id', 'department_name']);
    }

    public function down()
    {
        //
    }
}
