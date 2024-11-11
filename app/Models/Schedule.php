<?php

namespace App\Models;

use App\Enums\Days;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Schedule extends Model
{
    use HasFactory;
    protected $fillable = ['doctor_id', 'day', 'start_time', 'end_time'];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    protected $casts = [
        'day' => Days::class,
    ];
}
