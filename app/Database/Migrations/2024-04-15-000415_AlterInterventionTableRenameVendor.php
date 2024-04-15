<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterInterventionTableRenameVendor extends Migration
{
    public function up()
    {
        $this->forge->dropForeignKey('learning_intervention', 'learning_intervention_vendor_id_foreign');

        $this->forge->dropColumn('learning_intervention', 'vendor_id');

        $fields = [
            'trainer_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
        ];
        $this->forge->addColumn('learning_intervention', $fields);

        $this->forge->addForeignKey('trainer_id', 'employee', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->forge->dropColumn('learning_intervention', 'trainer_id');

        $fields = [
            'vendor_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
        ];
        $this->forge->addColumn('learning_intervention', $fields);
        $this->forge->addForeignKey('vendor_id', 'vendor', 'id', 'CASCADE', 'CASCADE');
    }
}


