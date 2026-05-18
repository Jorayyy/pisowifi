<?php

namespace App\Models;

use App\Traits\UseUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Voucher extends Model
{
    use HasFactory, UseUuid, SoftDeletes;

    protected $fillable = [
        'franchise_id', 'code', 'type', 'value', 'price', 
        'is_used', 'used_at', 'expires_at', 'device_id'
    ];

    protected $casts = [
        'used_at' => 'datetime',
        'expires_at' => 'datetime',
        'is_used' => 'boolean',
    ];

    public function franchise()
    {
        return $this->belongsTo(Franchise::class);
    }

    public function device()
    {
        return $this->belongsTo(Device::class);
    }
}
