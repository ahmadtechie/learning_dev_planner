<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RemoveEmployeeIDColumnFromUser extends Migration
{
    public function up()
    {
        $this->forge->dropColumn('user', 'employee_id');
    }

    public function down()
    {
        //
    }
}
