<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceMetric extends Model
{
    use HasFactory;

    protected $fillable = [
        'device_id', 'cpu_usage', 'ram_usage', 
        'temperature', 'connected_users', 'uptime'
    ];

    public function device()
    {
        return $this->belongsTo(Device::class);
    }
}
