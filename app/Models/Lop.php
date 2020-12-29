<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\GiaoVien;
use App\Models\HocSinh;
use App\Models\Khoi;
use App\Models\LichSuHoc;
use App\Models\NamHoc;
use App\Models\LichSuDay;

class Lop extends Model
{
    protected $table = 'lop_hoc';
    protected $fillable = [
        'khoi_id',
        'ten_lop',
    ];

    public function GiaoVien()
    {
        return $this->hasMany(GiaoVien::class,'lop_id','id');
    }

    public function HocSinh()
    {
        return $this->hasMany(HocSinh::class,'lop_id','id');
    }

    public function Khoi()
    {
        return $this->belongsTo(Khoi::class);
    }

    public function getGiaoVienPhuAttribute()
    {
        return $this->hasMany(GiaoVien::class)->select('id','ten','ma_gv')->where('type',2)->get();    
    }

    public function getGiaoVienChuNhiemAttribute()
    {
        return $this->hasMany(GiaoVien::class)->select('id','ten','ma_gv')->where('type',1)->first();    
    }

    public function getTongSoHocSinhAttribute()
    {
        return $this->hasMany(HocSinh::class)->where('lop_id',$this->id)->where('type',1)->count();    
    }

    public function LichSuHoc()
    {
        return $this->hasMany(LichSuHoc::class,'lop_id','id');    
    }

    public function LichSuDay()
    {
        return $this->hasMany(LichSuDay::class,'lop_id','id');    
    }

    public function getTongSoHocSinhLopCuAttribute()
    {
        return $this->hasMany(LichSuHoc::class)->where('lop_id',$this->id)->count();    
    }

    
    public function getLenLopTiepTheoAttribute()
    {
        $id_nam_hoc_moi = NamHoc::max('id');
        $khoi = Khoi::find($this->khoi_id);
        $tuoi_tiep_theo = $khoi->do_tuoi +1;   
        if($tuoi_tiep_theo > 5){
            return [];
        }
        $khoi_tiep_theo =Khoi::where('do_tuoi',$tuoi_tiep_theo)->where('nam_hoc_id',$id_nam_hoc_moi)->first();  
        
        return $khoi_tiep_theo->LopHoc;  
    }
    public function DonDanThuoc()
    {
        return $this->hasMany(DonDanThuoc::class,'lop_id','id');    
    }

    
}
