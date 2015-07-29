<?php

class Land extends \BaseModel {

    protected $table = 'land';
    protected $guarded = array('id', '_method', '_token');
    protected $fillable = array('description','turn' , 'number', 'area', 'price', 'status',
        'description', 'photo_id', 'gallery_id', 'sold', 'coordinate_x', 'coordinate_y');
    public static $rules = array('turn' => 'required', 'number' => 'required', 'price' => 'required',
        'coordinate_x' => 'required', 'coordinate_y' => 'required');

    public function photo() {
        return $this->hasOne('Photo', 'id', 'photo_id');
    }

    public function gallery() {
        return $this->hasOne('Gallery', 'id', 'gallery_id');
    }
}