@extends('admin.layout')

@section('title', 'Knowledge Base - Admin Panel')
@section('page-title', 'Knowledge Base')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div></div>
    <a href="{{ route('admin.knowledge.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>
        Tambah Knowledge
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
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Dibuat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($knowledge as $item)
                        <tr>
                            <td>{{ $loop->iteration + ($knowledge->currentPage() - 1) * $knowledge->perPage() }}</td>
                            <td>
                                <strong>{{ $item->title }}</strong>
                                <br>
                                <small class="text-muted">{{ Str::limit($item->content, 100) }}</small>
                            </td>
                            <td>
                                @if($item->category)
                                    <span class="badge bg-info">{{ $item->category }}</span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-{{ $item->is_active ? 'success' : 'secondary' }}">
                                    {{ $item->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>
                            <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.knowledge.edit', $item) }}" 
                                       class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.knowledge.destroy', $item) }}" 
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
                                Belum ada data knowledge base
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($knowledge->hasPages())
            <div class="d-flex justify-content-center">
                {{ $knowledge->links() }}
            </div>
        @endif
    </div>
</div>
@endsection