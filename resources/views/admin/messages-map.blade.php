@extends('admin.layout')

@section('main')

    @if (count($coords) > 0)
        <div class="col-xs-12">
            <div id="map"></div>
        </div>
    @else
        <div class="col-xs-12">No messages</div>
    @endif

@endsection

@push('style')
<link rel="stylesheet" property='stylesheet' href="/admin/css/messages-map.min.css">
@endpush

@push('script')
<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyAIpi0wvFb7yyxMzJZWXYxX3cEQn_byngU"></script>
<script type="text/javascript" src="/admin/js/messages-map.min.js"></script>
@endpush