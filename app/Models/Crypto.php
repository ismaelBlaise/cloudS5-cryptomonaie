<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crypto extends Model
{
    use HasFactory;
    protected $table = 'crypto'; // Nom de la table explicitement défini
    protected $fillable = ['nom'];
}
