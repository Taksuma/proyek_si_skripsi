<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Fungsi ini akan dieksekusi saat migration dijalankan (`php spark migrate`).
     * Tujuannya adalah untuk membuat skema tabel.
     */
    public function up()
    {
        // Mendefinisikan kolom-kolom untuk tabel 'users'
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'username' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'unique'     => true, // Pastikan username tidak ada yang sama
            ],
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => '255', // Untuk menyimpan password yang sudah di-hash
            ],
            'nama_lengkap' => [
                'type'       => 'VARCHAR',
                'constraint' => '150',
            ],
            'role' => [
                'type'       => 'ENUM',
                'constraint' => ['admin', 'dosen', 'mahasiswa'], // Hanya boleh diisi salah satu dari nilai ini
                'default'    => 'mahasiswa',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true, // Boleh kosong
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true, // Kolom ini sering digunakan oleh Model CodeIgniter
            ],
        ]);

        // Menentukan Primary Key
        $this->forge->addKey('id', true);

        // Membuat tabel 'users'
        $this->forge->createTable('users');
    }

    /**
     * Fungsi ini akan dieksekusi saat migration di-rollback.
     * Tujuannya adalah untuk menghapus tabel.
     */
    public function down()
    {
        // Menghapus tabel 'users'
        $this->forge->dropTable('users');
    }
}
