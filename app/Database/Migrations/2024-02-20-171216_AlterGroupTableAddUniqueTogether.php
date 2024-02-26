<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterGroupTableAddUniqueTogether extends Migration
{
    public function up()
    {
        $this->forge->addUniqueKey(['group_name', 'division_id']);
    }

    public function down()
    {
        //
    }
}
