@extends('admin.layout.app')
@section('content')
    <div class="m-2">
        @include('admin.layout.partials.alerts')
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="font-weight-bold mb-0 px-2">Web Views</h3>
                </div>
                {{-- <div>
                    <a href="{{ route('user.create') }}">
                        <button type="button" class="btn btn-primary btn-icon-text btn-rounded">
                            <i class="ti-plus btn-icon-prepend"></i>
                            tambah data
                        </button>
                    </a>
                </div> --}}
            </div>
        </div>
    </div>
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card position-relative">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>no</th>
                                <th>name</th>
                                <th>ipaddress</th>
                                <th>created at</th>
                                <th>updated at</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->users->name }}</td>
                                    <td>{{ $item->ipaddress }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->updated_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
@endpush
