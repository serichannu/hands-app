<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mockery\Matcher\Subset;

class Counter extends Model
{
    use HasFactory;
    protected $fillable = ['student_id', 'subject_id', 'date', 'count', 'counter_id'];

    public function student() {
        return $this->belongsTo(Student::class);
    }

    public function subject() {
        return $this->belongsTo(Subject::class);
    }

    public function evaluations() {
        return $this->hasMany(Evaluation::class);
    }
}
