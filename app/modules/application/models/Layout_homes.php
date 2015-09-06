<?php

class Layout_homes extends \BaseModel {

    protected $table = 'layout_homes';
    protected $guarded = array('id', '_method', '_token');
    protected $fillable = array('area', 'price', 'photo_id', 'gallery_id', 'title', 'contractor_title',
        'contractor_link', 'construction_period', 'land_id');
    public static $rules = array('title' => 'required');

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