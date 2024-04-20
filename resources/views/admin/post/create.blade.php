@extends('admin.layout.app')
@section('content')
    <div class="content-wrapper">
        @include('admin.layout.partials.alerts')
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="font-weight-bold mb-0 px-2">Add Post</h3>
                    </div>
                    <div>
                        <a href="/post">
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
                        <form class="forms-sample" action="{{ route('post.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title" required
                                    value="{{ old('title') }}">
                            </div>
                            <div class="form-group">
                                <label for="deskripsi">Description</label>
                                <textarea class="form-control" id="deskripsi" rows="3" name="deskripsi" required value="{{ old('deskripsi') }}"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="url">Url</label>
                                <input type="text" class="form-control" id="url" name="url" required value="{{ old('url') }}">
                            </div>
                            <div class="form-group">
                                <label>File upload</label>
                                <input type="file" class="form-control" placeholder="Upload Image" name="image[]">
                            </div>
                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
