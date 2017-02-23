@extends('admin.layout')

@section('main')

    <div class="col-xs-12">
        <div id="donutchart-device" class="donutchart"></div>
        <div id="donutchart-device-none"></div>
    </div>

    <div class="col-xs-12">
        <div id="donutchart-os" class="donutchart"></div>
        <div id="donutchart-os-none"></div>
    </div>

@endsection

@push('style')
<link rel="stylesheet" property='stylesheet' href="/admin/css/devices-statistics.min.css">
@endpush

@push('script')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript" src="/admin/js/devices-statistics.min.js"></script>
@endpush