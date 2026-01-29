<?php

namespace App\Models\Konfigurasi;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasUuids;

    protected $fillable = [
        'name',
        'url',
        'category',
        'active',
        'orders',
        'icon'
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    /**
     * Scope untuk filter menu yang aktif
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    /**
     * Scope untuk urutkan berdasarkan order dan name
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('name');
    }
}
