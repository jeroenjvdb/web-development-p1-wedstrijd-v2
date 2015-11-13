<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Winner extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'winners';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['competitor_id', 'date_id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */

    public function competitor()
    {
    	return $this->hasOne('App\Competitor', 'id', 'competitor_id');
    }

    public function date()
    {
        return $this->belongsTo('App\Date');
    }
}
