<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubBidang extends Model
{
    protected $table = "tsubbidang";
    protected  $fillable = ['kode_subBidang','nama_subBidang','bidang_id'];
    use HasFactory;
    public function Bidang(){
        return $this->belongsTo(Bidang::class);
    }

    public function Dokumen(){
        return $this->hasMany(Dokumen::class);
    }
}
