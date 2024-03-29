@extends('template.main')
@section('konten')
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data Akun</h1>
    <p class="mb-4">Data Akun Spp</p>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">


            </h6>
        </div>
        @if(Auth::user()->level == 'admin')

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-hover table-striped" id="dataTable" width="100%" cellspacing="0">

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Nama</th>
                            <th>Level</th>
                            <th>Aksi</th>

                    </thead>
                    <tbody>
                        @php
                        $no = 1; @endphp
                        @foreach ($akunn as $row)
                        <tr>
                            <td width="5%">{{ $no++ }}</td>
                            <td>{{ $row->username }}</td>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->level }}</td>
                            <td><a href="#" class="btn btn-sm btn-warning" data-toggle="modal"
                                    data-target="#editModal{{ $row->id }}">Edit</a>
                            </td>
                        </tr>
                        <div class="modal fade" id="editModal{{ $row->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="editModalLabel{{ $row->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel{{ $row ? $row->id : '' }}">Edit Data
                                            Siswa</h5>

                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="/akun/update/{{ $row->id }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group"> <label for="username">Username</label>
                                                <input type="text" class="form-control" id="username" name="username"
                                                    value="{{ $row->username }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="Name">Name</label>
                                                <input type="text" class="form-control" id="name" name="name"
                                                    value="{{ $row->name }}">
                                            </div>



                                            <div class="form-group">
                                                <label for="">Level</label>
                                                <select name="level" class="form-control">
                                                    @if($row->level == 'admin')
                                                    <option value="admin">Admin</option>
                                                    <option value="siswa">Siswa</option>
                                                    @endif
                                                    @if($row->level == 'siswa')
                                                    <option value="siswa">Siswa</option>
                                                    <option value="admin">Admin</option>
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="Password">Password</label>
                                                <input type="text" class="form-control" id="password" name="password">
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                            </div>
                                        </form>
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
@endif

@if(Auth::user()->level == 'siswa')

@foreach ($akunn as $row)

<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="editModalLabel{{ ($row) ? $row->id : '' }}">Update x`</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="/akun/update/{{ $row->id }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group"> <label for="username">Ganti Username Akun</label>
                    <input type="text" class="form-control" id="username" name="username" value="{{ $row->username }}">
                </div>
                <div class="form-group">
                    <label for="Name">Ganti Nama</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $row->name }}">
                </div>




                <div class="form-group">
                    <label for="Password">Ganti Password</label>
                    <input type="text" class="form-control" id="password" name="password">
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@endif
@endsection




@section('js')


@if(session('dataEdit'))
<script>
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})

Toast.fire({
    icon: 'success',
    title: 'Data Berhasil di Ubah'
})
</script>
@endif

@endsection