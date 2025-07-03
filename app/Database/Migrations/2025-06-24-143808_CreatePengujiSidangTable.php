<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePengujiSidangTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'jadwal_id' => [ // Foreign key
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'dosen_id' => [ // Foreign key
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'peran' => [
                'type'       => 'ENUM',
                'constraint' => ['pembimbing1', 'pembimbing2', 'penguji1', 'penguji2'],
            ],
            'nilai' => [
                'type'   => 'FLOAT',
                'null'   => true,
            ],
            'catatan' => [
                'type' => 'TEXT',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('jadwal_id', 'jadwal_sidang', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('dosen_id', 'dosen', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('penguji_sidang');
    }

    public function down()
    {
        $this->forge->dropTable('penguji_sidang');
    }
}