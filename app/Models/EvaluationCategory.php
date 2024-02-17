<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluationCategory extends Model
{
    use HasFactory;

    protected $fillable = ['counter_id', 'evaluation_category_id', 'count'];

    public function evaluations() {
        return $this->hasMany(Evaluation::class);
    }
}
