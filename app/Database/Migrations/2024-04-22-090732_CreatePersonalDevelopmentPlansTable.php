<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePersonalDevelopmentPlansTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'employee_id' => [
                'type'           => 'INT',
                'unsigned'       => true,
            ],
            'cycle_id' => [
                'type'           => 'INT',
                'unsigned'       => true,
            ],
            'competency_id' => [
                'type'           => 'INT',
                'unsigned'       => true,
            ],
            'average_rating' => [
                'type'           => 'FLOAT',
            ],
            'employee_signed_off' => [
                'type'           => 'BOOLEAN',
                'default'        => false,
            ],
            'line_manager_signed_off' => [
                'type'           => 'BOOLEAN',
                'default'        => false,
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('employee_id','employee','id','CASCADE','CASCADE');
        $this->forge->addForeignKey('cycle_id','development_cycle','id','CASCADE','CASCADE');
        $this->forge->addForeignKey('competency_id','competency','id','CASCADE','CASCADE');
        $this->forge->createTable('personal_development_plan');
    }

    public function down()
    {
        //
    }
}
