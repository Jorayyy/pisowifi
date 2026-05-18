<?php

namespace App\Models;

use App\Traits\UseUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Device extends Model
{
    use HasFactory, UseUuid, SoftDeletes;

    protected $fillable = [
        'franchise_id', 'serial_number', 'mac_address', 'name', 
        'location', 'ip_address', 'firmware_version', 'status', 
        'last_heartbeat', 'config'
    ];

    protected $casts = [
        'config' => 'array',
        'last_heartbeat' => 'datetime',
    ];

    public function franchise()
    {
        return $this->belongsTo(Franchise::class);
    }

    public function metrics()
    {
        return $this->hasMany(DeviceMetric::class);
    }

    public function sessions()
    {
        return $this->hasMany(Session::class);
    }
}
