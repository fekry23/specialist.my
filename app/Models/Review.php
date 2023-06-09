<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'reviews';

    protected $fillable = ['rating_value', 'title', 'description'];
    protected $guarded = [
        'id', 'employer_id', 'trainer_id', 'created_at', 'updated_at'
    ];

    use HasFactory;
}
