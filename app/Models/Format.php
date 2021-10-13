<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Format extends Model
{
    protected $table = "tformat";
    protected  $fillable = ['kode_format','nama_format'];
    use HasFactory;
    public function Dokumen(){
        return $this->hasMany(Dokumen::class);
    }
}
