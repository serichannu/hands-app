<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;
    protected $fillable = ['counter_id', 'evaluation_category_id', 'count'];
    public function counter() {
        return $this->belongsTo(Counter::class);
    }

    public function evaluation_category() {
        return $this->belongsTo(EvaluationCategory::class);
    }
}
