<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['titre', 'description', 'date_echeance', 'statut'];
    
    use HasFactory;

    public function histories()
    {
        return $this->hasMany(History::class);
    }
}
