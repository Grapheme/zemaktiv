@extends(Helper::layout())
@section('style')
  <style>.footer,.header{display: none;}</style>
@stop
@section('content')
@stop
@section('scripts')
  <script>
    Garden.overlays.open('poll');
  </script>
@stop