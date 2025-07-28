<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Http\Requests\AnnouncementRequest;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.announcements.index', compact('announcements'));
    }

    public function create()
    {
        return view('admin.announcements.create');
    }

    public function store(AnnouncementRequest $request)
    {
        Announcement::create($request->validated());
        return redirect()->route('admin.announcements.index')->with('success', 'Pengumuman berhasil ditambahkan');
    }

    public function edit(Announcement $announcement)
    {
        return view('admin.announcements.edit', compact('announcement'));
    }

    public function update(AnnouncementRequest $request, Announcement $announcement)
    {
        $announcement->update($request->validated());
        return redirect()->route('admin.announcements.index')->with('success', 'Pengumuman berhasil diupdate');
    }

    public function destroy(Announcement $announcement)
    {
        $announcement->delete();
        return redirect()->route('admin.announcements.index')->with('success', 'Pengumuman berhasil dihapus');
    }
}