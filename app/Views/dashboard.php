    <?= $this->extend('layout/template') ?>

    <?= $this->section('title') ?>
    <?= $page_title ?>
    <?= $this->endSection() ?>
    
    <?= $this->section('content_title') ?>
    <?= $page_title ?>
    <?= $this->endSection() ?>

    <?= $this->section('content') ?>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Selamat Datang!</h3>
        </div>
        <div class="card-body">
            Halo! Anda berada di halaman utama Sistem Informasi Penjadwalan Skripsi.
        </div>
    </div>
    <?= $this->endSection() ?>