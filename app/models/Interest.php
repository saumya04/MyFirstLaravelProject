<?php


class Interest extends Eloquent {

	public function students()
    {
        return $this->belongsToMany('Student');
    }

}