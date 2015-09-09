<?php $recommended_land = array();?>
@if(!empty($land->recommended))
    @foreach($land->recommended as $recommended)
        <?php $recommended_land[] = '"'.$recommended->recommended_land_id.'"'; ?>
    @endforeach
@endif
"{{ $land->id }}": {"id": {{ $land->id }}, "number": "{{ $land->number }}", "land_area": {{ $land->area }}, "price": {{ $land->price }}, "price_house": {{ $land->price_house }}, "price_total": {{ $land->price_house }}, "coordinate_x": {{ $land->coordinate_x }}, "coordinate_y": {{ $land->coordinate_y }}, "sold": {{ $land->sold }}, "status": {{ $land->status }}, "turn": {{ $land->turn }}, "clicks": "{{ $land->click }}", "recommended": [@if(!empty($recommended_land)){{ implode(',', $recommended_land); }}@endif]},