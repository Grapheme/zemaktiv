<?
/**
 * TITLE: Опрос
 * AVAILABLE_ONLY_IN_ADVANCED_MODE
 */
?>
@extends(Helper::layout())
@section('style')
    <style>.footer, .header {
            display: none;
        }</style>
@stop
@section('content')
@stop
@section('scripts')
    <script>
        Garden.overlays.open('poll');
    </script>
@stop