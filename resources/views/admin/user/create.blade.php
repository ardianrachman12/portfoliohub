@extends('admin.layout.app')
@section('content')
    <div class="content-wrapper">
        @include('admin.layout.partials.alerts')
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="font-weight-bold mb-0 px-2">Add User</h3>
                    </div>
                    <div>
                        <a href="/user">
                            <button type="button" class="btn btn-primary btn-icon-text btn-rounded">
                                <i class="ti-arrow-left btn-icon-prepend"></i>
                                kembali
                            </button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form class="forms-sample" action="{{route('user.store')}}" method="POST">
                            @csrf
                            {{-- @method('PUT') --}}
                            <div class="form-group">
                                <label for="name">fullname</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="username">username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="form-group">
                                <label for="email">email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">phone</label>
                                <input type="text" class="form-control" id="phone" name="phone" required>
                            </div>
                            <div class="form-group">
                                <label for="role">role</label>
                                <select class="form-control" name="role" id="role" required>
                                    <option selected disabled>pilih role</option>
                                    <option value="admin">admin</option>
                                    <option value="user">user</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="password">password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                            {{-- <button class="btn btn-light">Cancel</button> --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
