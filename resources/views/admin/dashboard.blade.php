@extends('admin.layout')

@section('title', 'Dashboard - Admin Panel')
@section('page-title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Knowledge Base
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $knowledgeCount }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-brain fa-2x text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Pengumuman
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $announcementCount }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-bullhorn fa-2x text-success"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Quick Actions</h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.knowledge.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>
                        Tambah Knowledge Base
                    </a>
                    <a href="{{ route('admin.announcements.create') }}" class="btn btn-success">
                        <i class="fas fa-plus me-2"></i>
                        Tambah Pengumuman
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Pengumuman Terbaru</h6>
            </div>
            <div class="card-body">
                @if($recentAnnouncements->count() > 0)
                    @foreach($recentAnnouncements as $announcement)
                        <div class="d-flex align-items-center mb-3">
                            <div class="flex-grow-1">
                                <div class="fw-bold">{{ $announcement->title }}</div>
                                <small class="text-muted">
                                    {{ $announcement->created_at->format('d/m/Y H:i') }}
                                </small>
                            </div>
                            <span class="badge bg-{{ $announcement->is_active ? 'success' : 'secondary' }}">
                                {{ $announcement->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </div>
                        @if(!$loop->last)
                            <hr>
                        @endif
                    @endforeach
                @else
                    <p class="text-muted">Belum ada pengumuman</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection