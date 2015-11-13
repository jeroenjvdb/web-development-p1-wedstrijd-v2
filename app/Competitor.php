<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Competitor extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'competitors';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['picture_url', 'ip'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    public function votes(){
    	return $this->hasMany('App\Vote', 'competitor_id', 'id');
    }

    public function getTotalVotes()
    {
        return $this->hasMany('App\Vote')->whereCompetitorId($this->id)->count();    
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function winner()
    {
        return $this->belongsTo('App\Competitor');
    }
}
