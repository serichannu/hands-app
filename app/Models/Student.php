<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PHPUnit\Framework\Constraint\Count;

class Student extends Model
{
    use HasFactory;

    public function seats() {
        return $this->hasMany(Seat::class);
    }

    public function users() {
        return $this->belongsTo(User::class);
    }

    public function counters() {
        return $this->hasMany(Counter::class);
    }
}
