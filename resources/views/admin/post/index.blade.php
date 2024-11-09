@extends('admin.layout.app')
@section('content')
    <div class="m-2">
        @include('admin.layout.partials.alerts')
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="font-weight-bold mb-0 px-2">Post</h3>
                </div>
                <div>
                    <a href="{{ route('post.create') }}">
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
                    <table id="myTable" class="table table-hover cell-border">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>title</th>
                                <th>description</th>
                                <th>url</th>
                                <th>tipe</th>
                                <th>image</th>
                                @if ($user->role == 'admin')
                                    <th>created by</th>
                                @endif
                                <th>action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $post)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ $post->deskripsi }}</td>
                                    <td><a style="text-wrap: balance;"
                                            href="{{ strpos($post->url, 'http://') === 0 || strpos($post->url, 'https://') === 0 ? $post->url : 'http://' . $post->url }}"
                                            target="_blank">{{ $post->url }}</a></td>
                                    <td>{{ $post->tipe }}</td>
                                    <td>
                                        <div class="">
                                            @if ($post->image)
                                                @foreach ($post->image as $image)
                                                    <img src="/uploads/{{ $image }}" alt="" width="100">
                                                @endforeach
                                            @endif
                                        </div>
                                    </td>
                                    @if ($user->role == 'admin')
                                        <td>{{ $post->users->name }}</td>
                                    @endif
                                    <td>
                                        <a href="#" class="btn btn-warning" data-toggle="modal"
                                            data-target="#editModal{{ $loop->iteration }}">Edit</a>
                                        <form action="{{ route('post.destroy', $post->id) }}" type="button" method="post"
                                            onsubmit="return confirm('Yakin akan dihapus?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger mt-2">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="editModal{{ $loop->iteration }}" tabindex="-1" role="dialog"
                                    aria-labelledby="editModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel">Edit Data</h5>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Form Edit -->
                                                <div class="mx-2">
                                                    <form class="forms-sample"
                                                        action="{{ route('post.update', $post->id) }}" method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="form-group">
                                                            <label for="title">Title</label>
                                                            <input type="text" class="form-control" id="title"
                                                                name="title" value="{{ $post->title }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="deskripsi">Description</label>
                                                            <textarea class="form-control" id="deskripsi" rows="3" name="deskripsi">{{ $post->deskripsi }}</textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="url">Url</label>
                                                            <input type="text" class="form-control" id="url"
                                                                name="url" value="{{ $post->url }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="tipe">Tipe</label>
                                                            <select class="form-control" name="tipe" id="tipe">
                                                                <option value="project"
                                                                    @if ($post->tipe == 'project') selected @endif>
                                                                    Project</option>
                                                                <option value="certificate"
                                                                    @if ($post->tipe == 'certificate') selected @endif>
                                                                    Certificate</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>File upload</label>
                                                            {{-- <input type="file" name="image" class="file-upload-default"> --}}
                                                            <div class="input-group col-xs-12">
                                                                <input type="file" class="form-control file-upload-info"
                                                                    placeholder="Upload Image" name="image[]" multiple>
                                                                {{-- <span class="input-group-append">
                                                                            <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                                                        </span> --}}
                                                            </div>
                                                            <div class="py-2">
                                                                @if ($post->image)
                                                                    @foreach ($post->image as $image)
                                                                        <img src="/uploads/{{ $image }}"
                                                                            alt="" width="100">
                                                                    @endforeach
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary me-2">Update</button>
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
            $('#myTable').DataTable({
                "columnDefs": [{
                    "targets": [1, 2],
                    "render": function(data, type, row) {
                        return '<div style="word-wrap: break-word; white-space: pre-line;">' +
                            data + '</div>';
                    }

                }]
            });
        });
    </script>
@endpush
