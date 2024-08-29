@extends('admin.layout.app')
@section('content')
    <div class="m-2">
        @include('admin.layout.partials.alerts')
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="font-weight-bold mb-0 px-2">Detail</h3>
                </div>
            </div>
        </div>
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Detail Ip Address</h4>
                    <ul>
                        <li><strong>IP Address:</strong> {{ $ipaddress->ipaddress }}</li>
                        <li><strong>Waktu Akses:</strong> {{ \Carbon\Carbon::parse($ipaddress->created_at)->format('d F Y, H:i:s') }}</li>
                        <li><strong>Country:</strong> {{ $ipDetails['country'] }}</li>
                        <li><strong>Region:</strong> {{ $ipDetails['regionName'] }}</li>
                        <li><strong>City:</strong> {{ $ipDetails['city'] }}</li>
                        <li><strong>ZIP:</strong> {{ $ipDetails['zip'] }}</li>
                        <li><strong>Latitude:</strong> {{ $ipDetails['lat'] }}</li>
                        <li><strong>Longitude:</strong> {{ $ipDetails['lon'] }}</li>
                        <li><strong>ISP:</strong> {{ $ipDetails['isp'] }}</li>
                        <li><strong>Organization:</strong> {{ $ipDetails['org'] }}</li>
                        <li><strong>AS:</strong> {{ $ipDetails['as'] }}</li>
                        <li><strong>Timezone:</strong> {{ $ipDetails['timezone'] }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
