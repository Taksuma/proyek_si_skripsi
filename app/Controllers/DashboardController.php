<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class DashboardController extends BaseController
{
    public function index()
    {
        // Data yang akan dikirim ke view
        $data = [
            'page_title' => 'Dashboard',
        ];

        // Menampilkan view dashboard
        return view('dashboard', $data);
    }
}
    