@extends('admin.layout')

@section('title', 'Pengumuman - Admin Panel')
@section('page-title', 'Pengumuman')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div></div>
    <a href="{{ route('admin.announcements.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>
        Tambah Pengumuman
    </a>
</div>

<div class="card shadow">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Tanggal Publikasi</th>
                        <th>Status</th>
                        <th>Dibuat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($announcements as $announcement)
                        <tr>
                            <td>{{ $loop->iteration + ($announcements->currentPage() - 1) * $announcements->perPage() }}</td>
                            <td>
                                <strong>{{ $announcement->title }}</strong>
                                <br>
                                <small class="text-muted">{{ Str::limit($announcement->content, 100) }}</small>
                            </td>
                            <td>
                                @if($announcement->published_at)
                                    {{ $announcement->published_at->format('d/m/Y H:i') }}
                                    <br>
                                    <small class="text-muted">
                                        @if($announcement->published_at <= now())
                                            <span class="badge bg-success">Sudah Terbit</span>
                                        @else
                                            <span class="badge bg-warning">Akan Terbit</span>
                                        @endif
                                    </small>
                                @else
                                    <span class="text-muted">Belum dijadwalkan</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-{{ $announcement->is_active ? 'success' : 'secondary' }}">
                                    {{ $announcement->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>
                            <td>{{ $announcement->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.announcements.edit', $announcement) }}" 
                                       class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.announcements.destroy', $announcement) }}" 
                                          method="POST" class="d-inline" 
                                          onsubmit="return confirm('Yakin ingin menghapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                Belum ada pengumuman
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($announcements->hasPages())
            <div class="d-flex justify-content-center">
                {{ $announcements->links() }}
            </div>
        @endif
    </div>
</div>
@endsection