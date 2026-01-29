<?php

namespace App\Http\Controllers\Konfigurasi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    private $title         = 'Menu Management';
    private $subtitle      = 'Pengaturan menu dinamis dan role-based access';
    private $label         = 'Daftar Menu';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'title'     => $this->title,
            'subtitle'  => $this->subtitle,
            'label'     => $this->label,
        ];

        return view('pages.konfigurasi.menu.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
