@extends('admin.layout')

@section('title', 'Edit Knowledge Base - Admin Panel')
@section('page-title', 'Edit Knowledge Base')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card shadow">
            <div class="card-body">
                <form action="{{ route('admin.knowledge.update', $knowledge) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="title" class="form-label">Judul <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" 
                               id="title" name="title" value="{{ old('title', $knowledge->title) }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="category" class="form-label">Kategori</label>
                        <input type="text" class="form-control @error('category') is-invalid @enderror" 
                               id="category" name="category" value="{{ old('category', $knowledge->category) }}" 
                               placeholder="Contoh: Login, Jadwal, Syarat, dll">
                        @error('category')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label">Konten <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('content') is-invalid @enderror" 
                                  id="content" name="content" rows="8" required>{{ old('content', $knowledge->content) }}</textarea>
                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="keywords" class="form-label">Keywords</label>
                        <input type="text" class="form-control @error('keywords') is-invalid @enderror" 
                               id="keywords" name="keywords" value="{{ old('keywords', $knowledge->keywords) }}" 
                               placeholder="Pisahkan dengan koma, contoh: login, password, masuk">
                        <div class="form-text">Keywords membantu chatbot menemukan informasi yang relevan</div>
                        @error('keywords')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_active" 
                                   name="is_active" value="1" {{ old('is_active', $knowledge->is_active) ? 'checked' : '' }}>
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
                        <a href="{{ route('admin.knowledge.index') }}" class="btn btn-secondary">
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
                <p><strong>Dibuat:</strong> {{ $knowledge->created_at->format('d/m/Y H:i') }}</p>
                <p><strong>Diupdate:</strong> {{ $knowledge->updated_at->format('d/m/Y H:i') }}</p>
                <p><strong>Status:</strong> 
                    <span class="badge bg-{{ $knowledge->is_active ? 'success' : 'secondary' }}">
                        {{ $knowledge->is_active ? 'Aktif' : 'Nonaktif' }}
                    </span>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection