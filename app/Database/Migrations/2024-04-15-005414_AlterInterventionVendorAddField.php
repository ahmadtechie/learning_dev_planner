<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterInterventionVendorAddField extends Migration
{
    public function up()
    {
        $fields = [
            'service_provided' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
        ];
        $this->forge->addColumn('intervention_vendor', $fields);
    }

    public function down()
    {
        //
    }
}
