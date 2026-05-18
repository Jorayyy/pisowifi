<?php

namespace App\Models;

use App\Traits\UseUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory, UseUuid;

    protected $fillable = [
        'franchise_id', 'device_id', 'reference_number', 
        'amount', 'method', 'status', 'gateway_response'
    ];

    protected $casts = [
        'gateway_response' => 'array',
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
