<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fisier extends Model
{
    protected $table = 'fisiere';

    protected $fillable = [
        'nume_original', 'nume_fisier', 'tip_fisier', 'marime', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function marimeFormatata()
    {
        if ($this->marime >= 1048576) {
            return round($this->marime / 1048576, 2) . ' MB';
        } elseif ($this->marime >= 1024) {
            return round($this->marime / 1024, 2) . ' KB';
        }
        return $this->marime . ' B';
    }
}