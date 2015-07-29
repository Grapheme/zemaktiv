<?php

class Buildings extends \BaseModel {

    protected $table = 'buildings';
    protected $guarded = array('id', '_method', '_token');
    protected $fillable = array('title', 'description', 'number', 'area', 'land_area', 'material', 'communication', 'price',
        'land_id', 'photo_id', 'gallery_id', 'sold');
    public static $rules = array('title' => 'required', 'number' => 'required', 'price' => 'required',
        'land_id' => 'required');

    public function photo() {
        return $this->hasOne('Photo', 'id', 'photo_id');
    }

    public function gallery() {
        return $this->hasOne('Gallery', 'id', 'gallery_id');
    }

    public function land(){

        return $this->hasOne('Land', 'id', 'land_id');
    }
}