<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMahasiswaTable extends Migration
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
            'user_id' => [ // Foreign key
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'nim' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
                'unique'     => true,
            ],
            'judul_proposal' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'status_skripsi' => [
                'type'       => 'ENUM',
                'constraint' => ['pengajuan', 'proposal', 'skripsi', 'lulus'],
                'default'    => 'pengajuan',
            ],
        ]);
        $this->forge->addKey('id', true);
        // Menambahkan foreign key constraint
        // 'CASCADE' berarti jika data di tabel 'users' dihapus, data mahasiswa terkait juga akan terhapus.
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('mahasiswa');
    }

    public function down()
    {
        $this->forge->dropTable('mahasiswa');
    }
}
