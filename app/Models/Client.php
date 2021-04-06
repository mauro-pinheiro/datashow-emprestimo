<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guard = [];

    public function category(){
        return $this->hasOne(ClientCategory::class);
    }

    public function loan(){
        return $this->hasMany(Loan::class);
    }
}
