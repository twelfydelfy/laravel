<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PollOption extends Model
{
    protected $fillable = ['poll_id', 'optiune'];

    public function votes()
    {
        return $this->hasMany(PollVote::class);
    }
}