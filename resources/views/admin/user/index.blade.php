@extends('admin.layout.app')
@section('content')
    <div class="m-2">
        @include('admin.layout.partials.alerts')
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="font-weight-bold mb-0 px-2">Users</h3>
                </div>
                <div>
                    <a href="{{ route('user.create') }}">
                        <button type="button" class="btn btn-primary btn-icon-text btn-rounded">
                            <i class="ti-plus btn-icon-prepend"></i>
                            tambah data
                        </button>
                    </a>
                </div>
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
                                <th>username</th>
                                <th>email</th>
                                <th>phone</th>
                                <th>role</th>
                                <th>views</th>
                                <th>action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->username }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>{{ $item->role }}</td>
                                    <td>{{ $item->views->views }}</td>
                                    <td>
                                        <a href="#" class="btn btn-warning" data-toggle="modal"
                                            data-target="#editModal{{ $loop->iteration }}">Edit</a>
                                        <form action="{{ route('user.destroy', $item->id) }}" type="button" method="POST"
                                            onsubmit="return confirm('Yakin akan dihapus?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger mt-2">Hapus</button>
                                        </form>
                                        <a target="_blank" href="{{route('user.show', $item->username)}}" class="btn btn-info mt-2">visit</a>
                                    </td>
                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="editModal{{ $loop->iteration }}" tabindex="-1" role="dialog"
                                    aria-labelledby="editModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel">Edit Data</h5>
                                                {{-- <button type="button" data-dismiss="modal"
                                                >
                                                <span aria-hidden="true">&times;</span>
                                            </button> --}}
                                            </div>
                                            <div class="modal-body">
                                                <!-- Form Edit -->
                                                <div class="mx-2">
                                                    <form class="forms-sample"
                                                        action="{{ route('user.update', $item->id) }}" method="POST">
                                                        @csrf
                                                        {{-- @method('PUT') --}}
                                                        <div class="form-group">
                                                            <label for="name">name</label>
                                                            <input type="text" class="form-control" id="name"
                                                                name="name" value="{{ $item->name }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="username">username</label>
                                                            <input type="text" class="form-control" id="username"
                                                                name="username" value="{{ $item->username }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="email">email</label>
                                                            <input type="email" class="form-control" id="email"
                                                                name="email" value="{{ $item->email }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="phone">phone</label>
                                                            <input type="text" class="form-control" id="phone"
                                                                name="phone" value="{{ $item->phone }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="role">role</label>
                                                            <select class="form-control" name="role" id="role">
                                                                <option selected value="{{ $item->role }}">
                                                                    {{ $item->role }}</option>
                                                                <option value="admin">admin</option>
                                                                <option value="user">user</option>
                                                            </select>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                                                        {{-- <button class="btn btn-light">Cancel</button> --}}
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
