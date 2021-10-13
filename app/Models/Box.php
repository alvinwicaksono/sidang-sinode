<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    protected $table = "tbox";
    protected $fillable = ['kode_box','nama_box','rak_id'];
    use HasFactory;

    public function Rak()
    {
        return $this->belongsTo(Rak::class);
    }
}
