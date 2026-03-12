<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'studenti';
    
    protected $fillable = [
        'nume', 'prenume', 'email', 'telefon', 'grupa', 'an_studiu'
    ];
}