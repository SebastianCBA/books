<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $table = 'books';
    protected $fillable = ['title', 'image', 'ISBN', 'descrition', 'created_at', 'updated_at'];
    protected $guarded = ['id'];        
}
