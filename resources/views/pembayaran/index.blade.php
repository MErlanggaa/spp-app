@extends('template.main')
@section('konten')
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data Pembayaran</h1>
    <p class="mb-4">Manajemen Spp | Inventory Spp</p>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">CRUD Laravel
                @if(Auth::user()->level == 'admin')
                <button class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#tambahData">Tambah
                    Data</button>

                <button class="btn btn-success" onclick="printTable()">Print</button>
                @endif

            </h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-hover table-striped" id="dataTable" width="100%" cellspacing="0">

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>Tanggal Pembayaran</th>
                            <th>Jumlah</th>
                            @if(Auth::user()->level == 'admin')
                            <th>Aksi</th>
                            @endif
                    </thead>
                    <tbody>
                        @php
                        $no = 1; @endphp
                        @foreach ($pembayaran as $row)
                        <tr>
                            <td width="5%">{{ $no++ }}</td>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->tgl_bayar }}</td>
                            <td>{{ $row->jumlah }}</td>
                            @if(Auth::user()->level == 'admin')
                            <td><a href="#" class="btn btn-sm btn-warning" data-toggle="modal"
                                    data-target="#editModal{{ $row->id }}">Edit</a> | <form
                                    action="{{ route('pembayaran.delete', $row->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Apakah ingin menghapus data?')">Hapus</button>
                                </form>

                            </td>
                            @endif

                        </tr>
                        <div class="modal fade" id="editModal{{ $row->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="editModalLabel{{ $row->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel{{ $row->id }}">Edit Data Siswa</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('pembayaran.update', $row->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group"> <label for="name">Nama Siswa</label>
                                                <input type="text" class="form-control" id="name" name="name"
                                                    value="{{ $row->name }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="tgl_bayar">Tanggal Pembayaran</label>
                                                <input type="date" class="form-control" id="tgl_bayar" name="tgl_bayar"
                                                    value="{{ $row->tgl_bayar }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="jumlah">Jumlah</label>
                                                <input type="number" class="form-control" id="jumlah" name="jumlah"
                                                    value="{{ $row->jumlah }}">
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


@endsection

@section('modals')
<div class="modal fade" id="tambahData" tabindex="-1" role="dialog" aria- labelledby="exampleModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog modal-dialog-centered modal- dialog-scrollable" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>

                <button class="close" type="button" data-dismiss="modal" aria- label="Close">

                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('pembayaran/save') }}" method="POST"> @csrf
                    <div class="form-group">
                        <label for="name">Nama Siswa</label>
                        <input type="text" class="form-control" id="name" aria-describedby="name" name="name">


                    </div>
                    <div class="form-group">
                        <label for="tanggal">Tanggal Pembayaran</label>
                        <input type="date" class="form-control" id="tgl_bayar" name="tgl_bayar">

                    </div>
                    <div class="form-group">
                        <label for="jumlah">Jumlah</label>
                        <input type="number" class="form-control" id="jumlah" name="jumlah">

                    </div>
            </div>
            <div class="modal-footer">

                <button class="btn btn-secondary" type="button" data- dismiss="modal">Cancel</button>
                <input type="submit" class="btn btn-primary" value="Simpan" name="simpan">

                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
@if (session('dataTambah'))
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
    title: 'Data Barang Berhasil Ditambah'
})
</script>
@endif

@if (session('dataEdit'))
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
@if (session('dataDelete'))
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
    title: 'Data Berhasil di Hapus'
})
</script>
@endif
<script>
function printTable() {
    var table = document.getElementById("dataTable");
    if (table) {
        var clonedTable = table.cloneNode(true);
        var actionColumnIndex = 4; // index of the action column (starting from 0)

        // Remove action column
        clonedTable.querySelectorAll("tr").forEach(function(row) {
            row.deleteCell(actionColumnIndex);
        });

        // Apply styles for printing
        clonedTable.style.width = "100%"; // Set table width to 100% for printing
        clonedTable.style.borderCollapse = "collapse"; // Collapse table borders
        clonedTable.style.fontSize = "12px"; // Set font size

        // Apply styles to table cells
        clonedTable.querySelectorAll("td, th").forEach(function(cell) {
            cell.style.border = "1px solid #dddddd"; // Add border to cells
            cell.style.padding = "8px"; // Add padding to cells
            cell.style.textAlign = "left"; // Align text to left
        });

        // Open a new window and print the table
        var newWin = window.open('', 'Print-Window');
        newWin.document.open();
        newWin.document.write('<html><head><title>Print Table</title></head><body>' + clonedTable.outerHTML +
            '</body></html>');
        newWin.document.close();
        newWin.print();
        setTimeout(function() {
            newWin.close();
        }, 10);
    }
}
</script>
@endsection