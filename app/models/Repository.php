<?php

class Repository extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

  public function user()
  {
    return $this->belongsTo('User');
  }

  public function commits()
  {
    return $this->hasMany('Commit');
  }
 
}
