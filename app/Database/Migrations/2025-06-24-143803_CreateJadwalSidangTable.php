<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateJadwalSidangTable extends Migration
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
            'mahasiswa_id' => [ // Foreign key
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'jenis_sidang' => [
                'type'       => 'ENUM',
                'constraint' => ['proposal', 'skripsi'],
            ],
            'waktu_sidang' => [
                'type' => 'DATETIME',
            ],
            'ruangan' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['dijadwalkan', 'selesai', 'dibatalkan'],
                'default'    => 'dijadwalkan',
            ],
            'berita_acara_file' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('mahasiswa_id', 'mahasiswa', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('jadwal_sidang');
    }

    public function down()
    {
        $this->forge->dropTable('jadwal_sidang');
    }
}