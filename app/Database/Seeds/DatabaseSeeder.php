<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Kita akan menonaktifkan pengecekan foreign key sementara
        // agar tidak terjadi error saat memasukkan data secara berurutan.
        $this->db->query('SET FOREIGN_KEY_CHECKS=0');

        // Mengosongkan semua tabel sebelum mengisi data baru
        $this->db->table('penguji_sidang')->truncate();
        $this->db->table('jadwal_sidang')->truncate();
        $this->db->table('dosen')->truncate();
        $this->db->table('mahasiswa')->truncate();
        $this->db->table('users')->truncate();

        // --- 1. MEMBUAT DATA PENGGUNA (USERS) ---

        $usersData = [
            // Akun Admin
            [
                'username'     => 'admin',
                'password'     => password_hash('password123', PASSWORD_DEFAULT),
                'nama_lengkap' => 'Administrator',
                'role'         => 'admin',
                'created_at'   => Time::now(),
            ],
            // Akun Dosen
            [
                'username'     => 'dosen1',
                'password'     => password_hash('password123', PASSWORD_DEFAULT),
                'nama_lengkap' => 'Prof. Dr. Budi Santoso',
                'role'         => 'dosen',
                'created_at'   => Time::now(),
            ],
            [
                'username'     => 'dosen2',
                'password'     => password_hash('password123', PASSWORD_DEFAULT),
                'nama_lengkap' => 'Dr. Indah Purnamasari',
                'role'         => 'dosen',
                'created_at'   => Time::now(),
            ],
             [
                'username'     => 'dosen3',
                'password'     => password_hash('password123', PASSWORD_DEFAULT),
                'nama_lengkap' => 'Ahmad Subagja, M.Kom.',
                'role'         => 'dosen',
                'created_at'   => Time::now(),
            ],
            // Akun Mahasiswa
            [
                'username'     => 'mahasiswa1',
                'password'     => password_hash('password123', PASSWORD_DEFAULT),
                'nama_lengkap' => 'Rina Amelia',
                'role'         => 'mahasiswa',
                'created_at'   => Time::now(),
            ],
            [
                'username'     => 'mahasiswa2',
                'password'     => password_hash('password123', PASSWORD_DEFAULT),
                'nama_lengkap' => 'Joko Susilo',
                'role'         => 'mahasiswa',
                'created_at'   => Time::now(),
            ],
        ];
        $this->db->table('users')->insertBatch($usersData);

        // --- 2. MEMBUAT DATA DOSEN & MAHASISWA ---

        // Ambil ID dari user yang baru saja dibuat untuk relasi
        $dosen1_user_id = $this->db->table('users')->where('username', 'dosen1')->get()->getRow()->id;
        $dosen2_user_id = $this->db->table('users')->where('username', 'dosen2')->get()->getRow()->id;
        $dosen3_user_id = $this->db->table('users')->where('username', 'dosen3')->get()->getRow()->id;
        $mhs1_user_id = $this->db->table('users')->where('username', 'mahasiswa1')->get()->getRow()->id;
        $mhs2_user_id = $this->db->table('users')->where('username', 'mahasiswa2')->get()->getRow()->id;

        // Data untuk tabel dosen
        $dosenData = [
            ['user_id' => $dosen1_user_id, 'nidn' => '0012345678'],
            ['user_id' => $dosen2_user_id, 'nidn' => '0023456789'],
            ['user_id' => $dosen3_user_id, 'nidn' => '0034567890'],
        ];
        $this->db->table('dosen')->insertBatch($dosenData);

        // Data untuk tabel mahasiswa
        $mahasiswaData = [
            [
                'user_id' => $mhs1_user_id, 
                'nim' => '11223344', 
                'judul_proposal' => 'Sistem Informasi Perpustakaan Berbasis Web',
                'status_skripsi' => 'proposal',
            ],
            [
                'user_id' => $mhs2_user_id, 
                'nim' => '22334455',
                'judul_proposal' => 'Analisis Sentimen pada Media Sosial Twitter',
                'status_skripsi' => 'skripsi',
            ],
        ];
        $this->db->table('mahasiswa')->insertBatch($mahasiswaData);
        
        // --- 3. MEMBUAT DATA JADWAL SIDANG ---

        // Ambil ID dari mahasiswa dan dosen yang akan digunakan
        $mhs1_id = $this->db->table('mahasiswa')->where('nim', '11223344')->get()->getRow()->id;
        $mhs2_id = $this->db->table('mahasiswa')->where('nim', '22334455')->get()->getRow()->id;
        $dosen1_id = $this->db->table('dosen')->where('nidn', '0012345678')->get()->getRow()->id;
        $dosen2_id = $this->db->table('dosen')->where('nidn', '0023456789')->get()->getRow()->id;
        $dosen3_id = $this->db->table('dosen')->where('nidn', '0034567890')->get()->getRow()->id;
        
        // Data Jadwal
        $jadwalData = [
            [
                'mahasiswa_id' => $mhs1_id,
                'jenis_sidang' => 'proposal',
                'waktu_sidang' => '2025-07-10 10:00:00',
                'ruangan'      => 'Ruang Sidang 1',
                'status'       => 'dijadwalkan',
            ],
            [
                'mahasiswa_id' => $mhs2_id,
                'jenis_sidang' => 'skripsi',
                'waktu_sidang' => '2025-07-11 14:00:00',
                'ruangan'      => 'Ruang Sidang 2',
                'status'       => 'dijadwalkan',
            ],
        ];
        $this->db->table('jadwal_sidang')->insertBatch($jadwalData);

        // --- 4. MEMBUAT DATA PENGUJI SIDANG ---
        
        // Ambil ID dari jadwal yang baru dibuat
        $jadwal1_id = $this->db->table('jadwal_sidang')->where('mahasiswa_id', $mhs1_id)->get()->getRow()->id;
        $jadwal2_id = $this->db->table('jadwal_sidang')->where('mahasiswa_id', $mhs2_id)->get()->getRow()->id;

        // Data Penugasan Dosen
        $pengujiData = [
            // Jadwal 1 (Proposal Rina)
            ['jadwal_id' => $jadwal1_id, 'dosen_id' => $dosen1_id, 'peran' => 'pembimbing1'],
            ['jadwal_id' => $jadwal1_id, 'dosen_id' => $dosen2_id, 'peran' => 'penguji1'],
            ['jadwal_id' => $jadwal1_id, 'dosen_id' => $dosen3_id, 'peran' => 'penguji2'],
            // Jadwal 2 (Skripsi Joko)
            ['jadwal_id' => $jadwal2_id, 'dosen_id' => $dosen2_id, 'peran' => 'pembimbing1'],
            ['jadwal_id' => $jadwal2_id, 'dosen_id' => $dosen1_id, 'peran' => 'penguji1'],
            ['jadwal_id' => $jadwal2_id, 'dosen_id' => $dosen3_id, 'peran' => 'penguji2'],
        ];
        $this->db->table('penguji_sidang')->insertBatch($pengujiData);

        // Mengaktifkan kembali pengecekan foreign key
        $this->db->query('SET FOREIGN_KEY_CHECKS=1');
        
        echo "Database seeding completed successfully!";
    }
}