<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resultado extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'palmares',
    ];

    public function edicion()
    {
        return $this->belongsTo(Edicion::class, 'id');
    }

}
