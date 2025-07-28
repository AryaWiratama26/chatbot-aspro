@extends('admin.layout')

@section('title', 'Tambah Knowledge Base - Admin Panel')
@section('page-title', 'Tambah Knowledge Base')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card shadow">
            <div class="card-body">
                <form action="{{ route('admin.knowledge.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="title" class="form-label">Judul <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" 
                               id="title" name="title" value="{{ old('title') }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="category" class="form-label">Kategori</label>
                        <input type="text" class="form-control @error('category') is-invalid @enderror" 
                               id="category" name="category" value="{{ old('category') }}" 
                               placeholder="Contoh: Login, Jadwal, Syarat, dll">
                        @error('category')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label">Konten <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('content') is-invalid @enderror" 
                                  id="content" name="content" rows="8" required>{{ old('content') }}</textarea>
                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="keywords" class="form-label">Keywords</label>
                        <input type="text" class="form-control @error('keywords') is-invalid @enderror" 
                               id="keywords" name="keywords" value="{{ old('keywords') }}" 
                               placeholder="Pisahkan dengan koma, contoh: login, password, masuk">
                        <div class="form-text">Keywords membantu chatbot menemukan informasi yang relevan</div>
                        @error('keywords')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_active" 
                                   name="is_active" value="1" {{ old('is_active', 1) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">
                                Aktif
                            </label>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>
                            Simpan
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
                <h6 class="mb-0">Tips Penulisan</h6>
            </div>
            <div class="card-body">
                <ul class="list-unstyled mb-0">
                    <li class="mb-2">
                        <i class="fas fa-lightbulb text-warning me-2"></i>
                        Gunakan judul yang jelas dan deskriptif
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-lightbulb text-warning me-2"></i>
                        Tulis konten yang informatif dan mudah dipahami
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-lightbulb text-warning me-2"></i>
                        Tambahkan keywords yang relevan untuk pencarian
                    </li>
                    <li>
                        <i class="fas fa-lightbulb text-warning me-2"></i>
                        Gunakan kategori untuk mengelompokkan informasi
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection