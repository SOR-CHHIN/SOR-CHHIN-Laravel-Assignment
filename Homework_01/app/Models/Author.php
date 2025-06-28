<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Books;

class Author extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'bio', 'nationality',
    ];

    public function books()
    {
        return $this->hasMany(Books::class); 
    }
}
