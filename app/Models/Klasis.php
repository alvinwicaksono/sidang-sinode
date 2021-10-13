<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Klasis extends Model
{
    protected $table = "tklasis";
    protected $fillable = ['nama_klasis','tahun_buka','kode_klasis','tahun_tutup'];
    use HasFactory;
    public function Lembaga(){
        return $this->hasMany(Lembaga::class);
    }
}
