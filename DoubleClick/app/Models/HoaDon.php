<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HoaDon extends Model
{
    protected $table = 'hoadon';
    protected $primaryKey = 'MaHD';
    protected $fillable = [
        'MaTK',
        'NgayLapHD',
        'SDT',
        'DiaChi',
        'TienShip',
        'TongTien',
        'KhuyenMai',
        'PhuongThucThanhToan',
        'MaVoucher',
        'TrangThai'
    ];
    public static function validate($request){
        $request->validate([
            "NgayLapHD"=>"requied",
            "SDT"=>"required|max:10",
            "DiaChi"=>"required|max:250",
            "TienShip"=>"required",
            "TongTien"=>"required",
            "KhuyenMai"=>"required",
            "PhuongThucThanhToan"=>"required",
            "MaVoucher"=>"required",
            "TrangThai"=>"required"
        ]);
    }
    public function getMaHD(){
        return $this->attributes['MaHD'];
    }
    public function getMaTK(){
        return $this->attributes['MaTK'];
    }
    public function setMaTK($maTK){
        $this->attributes['MaTK'] = $maTK;
    }
    public function getNgayLapHoaDon(){
        return $this->attributes['NgayLapHD'];
    }
    public function setNgayLapHoaDon($gayLapHoaDon){
        $this->attributes['NgayLapHD'] = $gayLapHoaDon;
    }
    public function getSDT(){
        return $this->attributes['SDT'];
    }
    public function setSDT($sDT){
        $this->attributes['SDT'] = $sDT;
    }
    public function getDiaChi(){
        return $this->attributes['DiaChi'];
    }
    public function setDiaChi($diaChi){
        $this->attributes['DiaChi'] = $diaChi;
    }
    public function getTienShip(){
        return $this->attributes['TienShip'];
    }
    public function setTienShip($tienShip){
        $this->attributes['TienShip'] = $tienShip;
    }
    public function getTongTien(){
        return $this->attributes['TongTien'];
    }
    public function setTongTien($tongTien){
        $this->attributes['TongTien'] = $tongTien;
    }
    public function getKhuyenMai(){
        return $this->attributes['KhuyenMai'];
    }
    public function setKhuyenMai($khuyenMai){
        $this->attributes['KhuyenMai'] = $khuyenMai;
    }
    public function getPhuongThucThanhToan(){
        return $this->attributes['PhuongThucThanhToan'];
    }
    public function setPhuongThucThanhToan($phuongThucThanhToan){
        $this->attributes['PhuongThucThanhToan'] = $phuongThucThanhToan;
    }
    public function getMaVoucher(){
        return $this->attributes['MaVoucher'];
    }
    public function setMaVoucher($maVouCher){
        $this->attributes['MaVoucher'] = $maVouCher;
    }
    public function getTrangThai(){
        return $this->attributes['TrangThai'];
    }
    public function setTrangThai($trangThai){
        $this->attributes['TrangThai'] = $trangThai;
    }
    //
    public $timestamps = false;
    public function chiTietHoaDon()
    {
        return $this->hasMany(chiTietHoaDon::class, 'MaHD');
    }
    public function taiKhoan()
    {
        return $this->belongsTo(TaiKhoan::class, 'MaTK', 'MaTK');
    }
    public function voucher()
    {
        return $this->belongsTo(Voucher::class, 'MaVoucher', 'MaVoucher');
    }

}

