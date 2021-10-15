<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sidang extends Model
{
    protected $fillable = [
        'akta_sidang',
        'penghimpun',
        'tema',
        'periode_awal',
        'periode_akhir',
        'tempat',
        'keterangan',
        'status',
    ];  
    use HasFactory;

    public function Sidang(){
        return $this->hasMany(Sidang::class);
    }


}
