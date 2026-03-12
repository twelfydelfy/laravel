<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    protected $fillable = ['titlu', 'descriere', 'activ'];

    public function options()
    {
        return $this->hasMany(PollOption::class);
    }

    public function votes()
    {
        return $this->hasMany(PollVote::class);
    }

    public function userVote($userId)
    {
        return $this->votes()->where('user_id', $userId)->first();
    }
}