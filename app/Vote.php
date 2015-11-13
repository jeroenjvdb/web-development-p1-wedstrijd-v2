<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'votes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['ip', 'competitor_id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    public function competitors(){
    	return $this->belongsTo('App\Competitor', 'competitor_id', 'id');
    }

    public function count()
    {
    return $this->hasOne('vote')->selectRaw('id, count(*) as count')->groupBy('id');
    // replace module_id with appropriate foreign key if needed
    }
}
