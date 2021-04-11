<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getStatusAttribute(){
        if(!is_null($this->return_date)){
            return 'Devolvido';
        }

        if(now() > $this->due_date){
            return 'Atrazado';
        }

        return 'Emprestado';
    }

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function equipament(){
        return $this->belongsTo(Equipament::class);
    }
}
