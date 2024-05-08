<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AnnualDevelopmentPlanTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
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
            'division_id' => [
                'type'           => 'INT',
                'unsigned'       => true,
            ],
            'department_id' => [
                'type'           => 'INT',
                'unsigned'       => true,
            ],
            'unit_id' => [
                'type'           => 'INT',
                'unsigned'       => true,
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('employee_id','employee','id','CASCADE','CASCADE');
        $this->forge->addForeignKey('cycle_id','development_cycle','id','CASCADE','CASCADE');
        $this->forge->addForeignKey('competency_id','competency','id','CASCADE','CASCADE');
        $this->forge->addForeignKey('division_id','division','id','CASCADE','CASCADE');
        $this->forge->addForeignKey('department_id','department','id','CASCADE','CASCADE');
        $this->forge->addForeignKey('unit_id','unit','id','CASCADE','CASCADE');
        $this->forge->createTable('annual_development_plan');
    }

    public function down()
    {
        //
    }
}
