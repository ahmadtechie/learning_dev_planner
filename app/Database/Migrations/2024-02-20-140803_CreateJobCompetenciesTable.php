<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateJobCompetenciesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'job_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'competency_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
        ]);
        $this->forge->addForeignKey('job_id', 'job', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('competency_id', 'competency', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('job_competencies');
    }

    public function down()
    {
        $this->forge->dropTable('job_competencies');
    }
}
