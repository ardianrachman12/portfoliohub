@extends('admin.layout.app')
@section('content')
    @include('admin.layout.partials.alerts')
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="font-weight-bold mb-0 px-2">Profile</h3>
                </div>
            </div>
        </div>
        {{-- </div>
    <div class="row"> --}}
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">User Profile</h4>
                    <p class="card-description">
                        Manage your User Account
                    </p>
                    <form class="forms-sample" action="{{ route('profile.updateProfile') }}" method="POST">
                        @csrf
                        {{-- @method('PUT') --}}
                        <div class="form-group">
                            <label for="name">Full Name <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" id="name" placeholder="Fullname" name="name"
                                value="{{ $user->name }}">
                        </div>
                        <div class="form-group">
                            <label for="username">Username <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" id="username" placeholder="Username" name="username"
                                value="{{ $user->username }}">
                        </div>
                        <div class="form-group">
                            <label for="email">Email <span style="color: red;">*</span></label>
                            <input type="Email" class="form-control" id="email" placeholder="Email" name="email"
                                value="{{ $user->email }}">
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" id="phone" placeholder="phone" name="phone"
                                value="{{ $user->phone }}">
                        </div>
                        <button class="btn btn-success">
                            Update
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Form Ubah Sandi</h4>
                    <p class="card-description">
                        Change your password
                    </p>
                    <form class="forms-sample" action="{{ route('profile.updatePassword') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="email">Current Password <span style="color: red;">*</span></label>
                            <input class="form-control" type="password" id="current_password" name="current_password">
                        </div>
                        <div class="form-group">
                            <label for="phone">New Password <span style="color: red;">*</span></label>
                            <input class="form-control" type="password" id="new_password" name="new_password">
                        </div>
                        <div class="form-group">
                            <label for="new_password_confirmation">Confirm New Password <span style="color: red;">*</span></label>
                            <input class="form-control" type="password" id="new_password_confirmation" name="new_password_confirmation">
                        </div>
                        <button class="btn btn-danger">
                            Change Password
                        </button>
                    </form>
                </div>
            </div>
        </div>
        {{-- <div class="row"> --}}
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Profiling</h4>
                    <p class="card-description">
                        Lengkapi informasi tentangmu untuk ditampilkan pada website mu
                    </p>
                    <form class="forms-sample" action="{{ route('profile.profiling') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="avatar">Avatar <span style="color: red;">*</span></label>
                            <input type="file" class="form-control" name="avatar" id="">
                            @if ($profiling)
                                <div class="py-2">
                                    <img src="/uploads/avatar/{{ $profiling->avatar }}" alt="" width="100">
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="description">Deskripsi <span style="color: red;">*</span></label>
                            <textarea class="form-control" name="description" id="description" rows="6" placeholder="Deskripsikan diri anda"
                                required>
@isset($profiling)
{{ $profiling->description }}
@endisset
</textarea>
                        </div>
                        <div class="form-group">
                            <label for="links1">Social Media Links</label>
                            <input type="links1" class="form-control" id="links1" placeholder="Facebook" name="links[]"
                                @if ($profiling) value="{{ $profiling->links[0] }}" @endif>
                            <input type="links2" class="form-control mt-2" id="links2" placeholder="Instagram"
                                name="links[]" @if ($profiling) value="{{ $profiling->links[1] }}" @endif>
                            <input type="links3" class="form-control mt-2" id="links3" placeholder="LinkedIn"
                                name="links[]" @if ($profiling) value="{{ $profiling->links[2] }}" @endif>
                            <input type="links4" class="form-control mt-2" id="links4" placeholder="Github"
                                name="links[]" @if ($profiling) value="{{ $profiling->links[3] }}" @endif>
                        </div>
                        <div class="form-group">
                            <label for="jobs">Jobs/Skills</label>
                            <input type="text" class="form-control" id="jobs1" placeholder="jobs1" name="jobs[]"
                                @if ($profiling) value="{{ $profiling->jobs[0] }}" @endif>
                            <input type="text" class="form-control mt-2" id="jobs2" placeholder="jobs2"
                                name="jobs[]" @if ($profiling) value="{{ $profiling->jobs[1] }}" @endif>
                            <input type="text" class="form-control mt-2" id="jobs3" placeholder="jobs3"
                                name="jobs[]" @if ($profiling) value="{{ $profiling->jobs[2] }}" @endif>
                        </div>
                        <hr>
                        <h4 class="card-title">Alamat</h4>
                        <div class="form-group">
                            <label for="district">Desa <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" id="district" placeholder="district"
                                name="district"
                                @if ($profiling) value="{{ $profiling->district }}" @endif required>
                        </div>
                        <div class="form-group">
                            <label for="subdistrict">Kecamatan <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" id="subdistrict" placeholder="subdistrict"
                                name="subdistrict"
                                @if ($profiling) value="{{ $profiling->subdistrict }}" @endif required>
                        </div>
                        <div class="form-group">
                            <label for="subdistrict">Provinsi <span style="color: red;">*</span></label>
                            <select class="form-control" id="province" name="province" required>
                                <option value="" disabled selected>Pilih Provinsi</option>
                                @if ($profiling)
                                    <option value="{{ $profiling->province }}" selected>{{ $value_province_title }}
                                    </option>
                                @endif
                                @foreach ($data_province as $item)
                                    <option value="{{ $item['id'] }}">{{ $item['title'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="regency">Kabupaten/Kota <span style="color: red;">*</span></label>
                            <select class="form-control" name="regency" id="destination" required>
                                <option selected disabled>Pilih Kabupaten/Kota</option>
                                @if ($profiling)
                                    <option value="{{ $profiling->regency }}" selected>{{ $value_regency_title }}
                                    </option>
                                @endif
                                @foreach ($data_regency as $item)
                                    <option value="{{ $item['id'] }}">{{ $item['title'] }}</option>
                                @endforeach
                            </select>
                            {{-- <input type="text" class="form-control" id="regency" placeholder="regency" name="regency"> --}}
                        </div>
                        <div class="form-group">
                            <label for="postal_code">Kode Pos <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" id="postal_code" placeholder="Kode Pos"
                                name="postal_code"
                                @if ($profiling) value="{{ $profiling->postal_code }}" @endif readonly>
                        </div>
                        <button class="btn btn-success">
                            Update
                        </button>
                    </form>
                </div>
            </div>
        </div>
        {{-- </div> --}}
    </div>
@endsection
@push('scripts')
<script>
    $(function() {

        $('#province').on('change', function() {
            let id_province = $('#province').val();

            $.ajax({
                type: 'POST',
                url: "{{ route('selectProvince') }}",
                data: {
                    _token: '{{ csrf_token() }}',
                    id_province: id_province
                },
                cache: false,

                success: function(data) {
                    console.log(data);

                    // Clear existing options
                    $('#destination').empty();

                    // Append "Pilih kota/kabupaten" option
                    $('#destination').append('<option value="" selected disabled>Pilih kota/kabupaten</option>');

                    // Append new options based on the selected province
                    $.each(data.regency, function(index, regency) {
                        $('#destination').append('<option value="' + regency.id +
                            '">' + regency.title + '</option>');
                    });

                },
                error: function(data) {
                    console.log('error:', data)
                },
            })
        });

    })
</script>

    <script>
        $(function() {
            $('#destination').on('change', function() {
                let id_destination = $('#destination').val();

                $.ajax({
                    type: 'POST',
                    url: "{{ route('selectRegency') }}",
                    data: {
                        _token: '{{ csrf_token() }}',
                        id_destination: id_destination
                    },
                    cache: false,

                    success: function(response) {
                        // console.log(response);
                        if (response.postal_code.length > 0) {
                            $('#postal_code').val(response.postal_code[0].postal_code);
                        } else {
                            // Handle the case when no postal code is found
                            $('#postal_code').val('');
                        }
                    },
                    error: function(data) {
                        console.log('error:', data)
                    },
                })
            })
        });
    </script>
@endpush
