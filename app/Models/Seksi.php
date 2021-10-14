<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seksi extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_seksi'
    ];

    public function User(){
        return $this->hasMany(User::class);
    }
}
