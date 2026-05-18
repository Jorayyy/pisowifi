<?php

namespace App\Models;

use App\Traits\UseUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FirmwareVersion extends Model
{
    use HasFactory, UseUuid;

    protected $fillable = [
        'version', 'file_path', 'checksum', 
        'changelog', 'is_stable'
    ];

    protected $casts = [
        'is_stable' => 'boolean',
    ];
}
