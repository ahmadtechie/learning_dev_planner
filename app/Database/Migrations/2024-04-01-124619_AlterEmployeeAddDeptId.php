<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterEmployeeAddDeptId extends Migration
{
    public function up()
    {
        $this->forge->dropColumn('employee', 'is_active');
    }

    public function down()
    {
        //
    }
}
