<?php

class RecommendedLands extends \BaseModel {

    protected $table = 'recommended_lands';
    protected $guarded = array('id', '_method', '_token');
    protected $fillable = array('land_id','recommended_land_id');

    public function land() {
        return $this->belongsTo('Land', 'land_id', 'id');
    }

    public function recommended_land() {

        return $this->belongsTo('Land', 'recommended_land_id', 'id');
    }
}