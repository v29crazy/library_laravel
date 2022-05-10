<?php

namespace App\Modules\Book\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'cover',
        'description',
        'content',
        'state',
        'hits',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
