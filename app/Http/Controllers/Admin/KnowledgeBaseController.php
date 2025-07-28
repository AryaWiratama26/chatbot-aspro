<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KnowledgeBase;
use App\Http\Requests\KnowledgeBaseRequest;

class KnowledgeBaseController extends Controller
{
    public function index()
    {
        $knowledge = KnowledgeBase::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.knowledge.index', compact('knowledge'));
    }

    public function create()
    {
        return view('admin.knowledge.create');
    }

    public function store(KnowledgeBaseRequest $request)
    {
        KnowledgeBase::create($request->validated());
        return redirect()->route('admin.knowledge.index')->with('success', 'Knowledge base berhasil ditambahkan');
    }

    public function edit(KnowledgeBase $knowledge)
    {
        return view('admin.knowledge.edit', compact('knowledge'));
    }

    public function update(KnowledgeBaseRequest $request, KnowledgeBase $knowledge)
    {
        $knowledge->update($request->validated());
        return redirect()->route('admin.knowledge.index')->with('success', 'Knowledge base berhasil diupdate');
    }

    public function destroy(KnowledgeBase $knowledge)
    {
        $knowledge->delete();
        return redirect()->route('admin.knowledge.index')->with('success', 'Knowledge base berhasil dihapus');
    }
}