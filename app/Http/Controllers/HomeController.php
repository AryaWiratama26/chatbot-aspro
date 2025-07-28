<?php

namespace App\Http\Controllers;

use App\Models\Announcement;

class HomeController extends Controller
{
    public function index()
    {
        $announcements = Announcement::active()
            ->published()
            ->orderBy('published_at', 'desc')
            ->limit(5)
            ->get();

        return view('home', compact('announcements'));
    }
}