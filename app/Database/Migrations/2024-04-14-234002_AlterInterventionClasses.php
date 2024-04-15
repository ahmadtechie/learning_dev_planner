<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterInterventionClasses extends Migration
{
    public function up()
    {
        $this->forge->dropColumn('intervention_class', 'cost');

    }

    public function down()
    {
        //
    }
}
