<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lembaga extends Model
{
    protected $table = "tlembaga";
    protected $fillable =['kode_lembaga','nama_lembaga','tgl_berdiri','alamat','status','klasis_id'];
    use HasFactory;
    public function Klasis(){
        return $this->belongsTo(Klasis::class);
    }
}
