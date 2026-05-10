<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model {
    protected $guarded = [];

    public function poliklinik() {
        return $this->belongsTo(Poliklinik::class);
    }
    public function antreans() {
        return $this->hasMany(Antrean::class);
    }
}