<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'matricula',
        'name',
        'email',
    ];

    public function category(){
        return $this->belongsTo(ClientCategory::class, 'client_category_id');
    }

    public function loan(){
        return $this->hasMany(Loan::class);
    }
}
