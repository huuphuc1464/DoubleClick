<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table = 'banners';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $primaryKey = 'MaBanner';
    protected $fillable = [
        'MaBanner',
        'Imagebanner',
        'MaSach'
    ];
    public function sach()
    {
        return $this->belongsTo(Sach::class, 'MaSach');
    }
}
