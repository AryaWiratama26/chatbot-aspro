@extends('admin.layout')

@section('title', 'Edit Pengumuman - Admin Panel')
@section('page-title', 'Edit Pengumuman')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card shadow">
            <div class="card-body">
                <form action="{{ route('admin.announcements.update', $announcement) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="title" class="form-label">Judul <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" 
                               id="title" name="title" value="{{ old('title', $announcement->title) }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label">Konten <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('content') is-invalid @enderror" 
                                  id="content" name="content" rows="8" required>{{ old('content', $announcement->content) }}</textarea>
                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="published_at" class="form-label">Tanggal & Waktu Publikasi <span class="text-danger">*</span></label>
                        <input type="datetime-local" class="form-control @error('published_at') is-invalid @enderror" 
                               id="published_at" name="published_at" 
                               value="{{ old('published_at', $announcement->published_at ? $announcement->published_at->format('Y-m-d\TH:i') : '') }}" required>
                        <div class="form-text">Pengumuman akan muncul sesuai waktu yang ditentukan</div>
                        @error('published_at')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_active" 
                                   name="is_active" value="1" {{ old('is_active', $announcement->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">
                                Aktif
                            </label>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>
                            Update
                        </button>
                        <a href="{{ route('admin.announcements.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>
                            Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card bg-light">
            <div class="card-header">
                <h6 class="mb-0">Informasi</h6>
            </div>
            <div class="card-body">
                <p><strong>Dibuat:</strong> {{ $announcement->created_at->format('d/m/Y H:i') }}</p>
                <p><strong>Diupdate:</strong> {{ $announcement->updated_at->format('d/m/Y H:i') }}</p>
                <p><strong>Status:</strong> 
                    <span class="badge bg-{{ $announcement->is_active ? 'success' : 'secondary' }}">
                        {{ $announcement->is_active ? 'Aktif' : 'Nonaktif' }}
                    </span>
                </p>
                @if($announcement->published_at)
                    <p><strong>Publikasi:</strong>
                        @if($announcement->published_at <= now())
                            <span class="badge bg-success">Sudah Terbit</span>
                        @else
                            <span class="badge bg-warning">Akan Terbit</span>
                        @endif
                    </p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection