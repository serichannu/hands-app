<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    use HasFactory;

    public function my_class() {
        return $this->belongsTo(MyClass::class);
    }

    public function student() {
        return $this->belongsTo(Student::class);
    }
}
