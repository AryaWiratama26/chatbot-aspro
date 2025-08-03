@extends('admin.layout')

@section('title', 'Dashboard - Admin Panel')
@section('page-title', 'Dashboard')

@section('content')
<div class="row" style="display: flex; flex-wrap: wrap; margin: 0 -0.75rem;">
    <div class="col-xl-3 col-md-6" style="flex: 0 0 25%; padding: 0 0.75rem; margin-bottom: 1.5rem;">
        <div class="card" style="background: #1f2937; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.3); border: 1px solid #374151; height: 100%;">
            <div class="card-body" style="padding: 1.5rem;">
                <div class="row" style="display: flex; align-items: center;">
                    <div class="col" style="flex: 1;">
                        <div class="text-xs" style="font-size: 0.75rem; font-weight: 600; color: #3b82f6; text-transform: uppercase; margin-bottom: 0.5rem;">
                            Knowledge Base
                        </div>
                        <div class="h5" style="font-size: 1.5rem; font-weight: 600; color: #f9fafb; margin: 0;">{{ $knowledgeCount }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-brain" style="font-size: 2rem; color: #3b82f6;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6" style="flex: 0 0 25%; padding: 0 0.75rem; margin-bottom: 1.5rem;">
        <div class="card" style="background: #1f2937; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.3); border: 1px solid #374151; height: 100%;">
            <div class="card-body" style="padding: 1.5rem;">
                <div class="row" style="display: flex; align-items: center;">
                    <div class="col" style="flex: 1;">
                        <div class="text-xs" style="font-size: 0.75rem; font-weight: 600; color: #22c55e; text-transform: uppercase; margin-bottom: 0.5rem;">
                            Pengumuman
                        </div>
                        <div class="h5" style="font-size: 1.5rem; font-weight: 600; color: #f9fafb; margin: 0;">{{ $announcementCount }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-bullhorn" style="font-size: 2rem; color: #22c55e;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row" style="display: flex; flex-wrap: wrap; margin: 0 -0.75rem;">
    <div class="col-lg-6" style="flex: 0 0 50%; padding: 0 0.75rem; margin-bottom: 1.5rem;">
        <div class="card" style="background: #1f2937; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.3); border: 1px solid #374151;">
            <div class="card-header" style="background: #374151; padding: 1rem 1.5rem; border-bottom: 1px solid #4b5563; border-radius: 12px 12px 0 0;">
                <h6 style="margin: 0; font-weight: 600; color: #3b82f6;">Quick Actions</h6>
            </div>
            <div class="card-body" style="padding: 1.5rem;">
                <div class="d-grid" style="display: grid; gap: 0.5rem;">
                    <a href="{{ route('admin.knowledge.create') }}" class="btn" style="background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%); border: none; color: #f9fafb; padding: 0.75rem 1.5rem; border-radius: 8px; font-weight: 500; text-decoration: none; display: flex; align-items: center; gap: 0.5rem; transition: all 0.2s ease;">
                        <i class="fas fa-plus"></i>
                        Tambah Knowledge Base
                    </a>
                    <a href="{{ route('admin.announcements.create') }}" class="btn" style="background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%); border: none; color: #f9fafb; padding: 0.75rem 1.5rem; border-radius: 8px; font-weight: 500; text-decoration: none; display: flex; align-items: center; gap: 0.5rem; transition: all 0.2s ease;">
                        <i class="fas fa-plus"></i>
                        Tambah Pengumuman
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6" style="flex: 0 0 50%; padding: 0 0.75rem; margin-bottom: 1.5rem;">
        <div class="card" style="background: #1f2937; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.3); border: 1px solid #374151;">
            <div class="card-header" style="background: #374151; padding: 1rem 1.5rem; border-bottom: 1px solid #4b5563; border-radius: 12px 12px 0 0;">
                <h6 style="margin: 0; font-weight: 600; color: #3b82f6;">Pengumuman Terbaru</h6>
            </div>
            <div class="card-body" style="padding: 1.5rem;">
                @if($recentAnnouncements->count() > 0)
                    @foreach($recentAnnouncements as $announcement)
                        <div class="d-flex" style="display: flex; align-items: center; margin-bottom: 1rem;">
                            <div class="flex-grow-1" style="flex: 1;">
                                <div class="fw-bold" style="font-weight: 600; color: #f9fafb;">{{ $announcement->title }}</div>
                                <small style="color: #9ca3af; font-size: 0.875rem;">
                                    {{ $announcement->created_at->format('d/m/Y H:i') }}
                                </small>
                            </div>
                            <span class="badge" style="padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 500; background-color: {{ $announcement->is_active ? '#22c55e' : '#6b7280' }}; color: #f9fafb;">
                                {{ $announcement->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </div>
                        @if(!$loop->last)
                            <hr style="border: none; border-top: 1px solid #374151; margin: 1rem 0;">
                        @endif
                    @endforeach
                @else
                    <p style="color: #9ca3af; margin: 0;">Belum ada pengumuman</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection