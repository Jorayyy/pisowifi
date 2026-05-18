<?php

namespace App\Models;

use App\Traits\UseUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory, UseUuid;

    protected $fillable = [
        'device_id', 'voucher_id', 'mac_address', 
        'started_at', 'ends_at', 'data_limit', 
        'data_used', 'status'
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'ends_at' => 'datetime',
    ];

    public function device()
    {
        return $this->belongsTo(Device::class);
    }

    public function voucher()
    {
        return $this->belongsTo(Voucher::class);
    }
}
