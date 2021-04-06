<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipament extends Model
{
    use HasFactory;

    protected $guard = [];

    public function loan(){
        return $this->hasMany(Loan::class);
    }
}
