<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bidang extends Model
{
    protected $table = 'tbidang';
    protected  $fillable = ['kode_bidang','nama_bidang'];
    use HasFactory;

    public function SubBidang()
    {
        return $this->hasMany(SubBidang::class);
    }
}
