@extends('admin.layout')
@section('content')

<h4 class="mt-5">Data Sampah</h4>

<div class="d-flex mb-3">
    <a href="{{ route('admin.index') }}" type="button" class="btn btn-success rounded-3 me-2">Back</a>
    @if(count($datas) > 0)
    <a href="#" type="button" class="btn btn-warning rounded-3" data-bs-toggle="modal" data-bs-target="#undoAllModal">Undo All Data</a>
    @endif
</div>

@if($message = Session::get('success'))
<div class="alert alert-success mt-3" role="alert">
    {{ $message }}
</div>
@endif

<table class="table table-hover mt-2">
    <thead>
        <tr>
            <th>No.</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Username</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($datas as $data)
        <tr>
            <td>{{ $data->id_admin }}</td>
            <td>{{ $data->nama_admin }}</td>
            <td>{{ $data->alamat }}</td>
            <td>{{ $data->username }}</td>
            <td>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal{{ $data->id_admin }}">
                    Hapus
                </button>
                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#undoModal{{ $data->id_admin }}">
                    Undo
                </button>

                <!-- Modal Hapus Permanen -->
                <div class="modal fade" id="hapusModal{{ $data->id_admin }}" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="hapusModalLabel">Konfirmasi</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form method="POST" action="{{ route('admin.force.delete', $data->id_admin) }}">
                                @csrf
                                @method('DELETE')
                                <div class="modal-body">
                                    Apakah anda yakin ingin menghapus data ini secara permanen?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary">Ya</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Modal Undo -->
                <div class="modal fade" id="undoModal{{ $data->id_admin }}" tabindex="-1" aria-labelledby="undoModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="undoModalLabel">Konfirmasi Undo</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Apakah Anda yakin ingin mengembalikan data ini?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <a href="{{ route('admin.restore', $data->id_admin) }}" class="btn btn-primary text-white">Ya, Undo</a>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="text-center">Tidak ada data di sampah</td>
        </tr>
        @endforelse
    </tbody>
</table>

<!-- Modal Undo All Data - Persis seperti gambar -->
<div class="modal fade" id="undoAllModal" tabindex="-1" aria-labelledby="undoAllModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title fw-bold" id="undoAllModalLabel">Konfirmasi Undo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-3">
                Apakah Anda yakin ingin mengembalikan data ini?
            </div>
            <div class="modal-footer border-top-0">
                <button type="button" class="btn btn-secondary rounded" data-bs-dismiss="modal">Tutup</button>
                <a href="{{ route('admin.restore.all') }}" class="btn btn-primary rounded text-white">Ya, Undo</a>
            </div>
        </div>
    </div>
</div>

<style>
    /* Styling untuk modal sesuai gambar */
    .modal-content {
        border-radius: 8px;
        border: none;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .modal-header {
        padding: 1rem 1rem 0.5rem 1rem;
    }
    
    .modal-body {
        padding: 0.5rem 1rem;
    }
    
    .modal-footer {
        padding: 0.5rem 1rem 1rem 1rem;
    }
    
    .btn-primary {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }
    
    .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
        color: white;
    }
    
    .btn-close {
        background: transparent;
        font-size: 1.5rem;
        opacity: .5;
    }
    
    /* Khusus untuk modal yang sesuai gambar */
    #undoModal .modal-content, #undoAllModal .modal-content {
        max-width: 500px;
        margin: 0 auto;
    }
    
    #undoModal .modal-header, #undoAllModal .modal-header {
        border-bottom: none;
    }
    
    #undoModal .modal-footer, #undoAllModal .modal-footer {
        border-top: none;
        justify-content: flex-end;
    }
    
    #undoModal .btn, #undoAllModal .btn {
        border-radius: 4px;
        padding: 0.375rem 1.5rem;
    }
    
    #undoModal .btn-primary, #undoAllModal .btn-primary {
        background-color: #0d6efd;
    }
    
    #undoModal .btn-secondary, #undoAllModal .btn-secondary {
        background-color: #6c757d;
    }
</style>
@stop