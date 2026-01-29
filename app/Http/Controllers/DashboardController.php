<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private $title         = 'Dashboard';

    public function index()
    {
        $data = [
            'title' => $this->title,
        ];

        return view('pages.dashboard.dashboard-administrator', $data);
    }
}
