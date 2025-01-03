<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DSYeuThich extends Model
{
    protected $table = 'dsyeuthich';
    protected $fillable = ['MaTK', 'MaSach'];
    public function sach()
    {
        return $this->belongsTo(Sach::class, 'MaSach', 'MaSach');
    }
}
