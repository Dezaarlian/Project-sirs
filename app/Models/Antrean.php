<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Antrean extends Model {
    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function jadwal() {
        return $this->belongsTo(Jadwal::class);
    }
}