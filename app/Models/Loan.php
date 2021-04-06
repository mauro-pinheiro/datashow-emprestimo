<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $guard = [];

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
        return $this->belongTo(Client::class);
    }

    public function user(){
        return $this->belongTo(User::class);
    }

    public function equipament(){
        return $this->belongTo(Equipament::class);
    }
}
