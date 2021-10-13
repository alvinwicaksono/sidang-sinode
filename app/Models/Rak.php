<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rak extends Model
{
    protected $table = "trak";
    protected $fillable = ['kode_rak','nama_rak'];
    use HasFactory;
    public function Box(){
        return $this->hasMany(Box::class);
    }
}
