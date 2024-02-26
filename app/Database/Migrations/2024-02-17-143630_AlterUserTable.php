<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterUserTable extends Migration
{
    public function up()
    {
        // Drop the foreign key constraint on the 'employee_id' column
        $this->forge->dropForeignKey('user', 'user_employee_id_foreign');
    }

    public function down()
    {
        //
    }
}