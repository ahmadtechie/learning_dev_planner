<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterInterventionTable extends Migration
{
    public function up()
    {
        $this->forge->dropColumn('learning_intervention', 'class_name');
        $this->forge->dropColumn('learning_intervention', 'start_date');
        $this->forge->dropColumn('learning_intervention', 'end_date');
        $this->forge->dropColumn('learning_intervention', 'venue');
        $this->forge->dropColumn('learning_intervention', 'cost');
    }

    public function down()
    {
        //
    }
}
