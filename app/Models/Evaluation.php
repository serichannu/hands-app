<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;
    public function counter() {
        return $this->belongsTo(Counter::class);
    }

    public function evaluation_category() {
        return $this->belongsTo(EvaluationCategory::class);
    }
}
