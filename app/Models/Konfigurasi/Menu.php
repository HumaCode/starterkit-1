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
}
