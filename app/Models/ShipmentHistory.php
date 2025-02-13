<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipmentHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'tracking_number',
        'carrier',
        'tracking_data',
        'user_id',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}