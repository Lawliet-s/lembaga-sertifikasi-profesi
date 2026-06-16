<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return view('post.index');
    }

    public function create()
    {
        return view('post.create');
    }

    public function store(Request $request)
    {
        $request->validate(['title' => 'required|string|max:255']);
        return redirect()->route('post.index');
    }

    public function show($id)
    {
        return view('post.show', ['id' => $id]);
    }

    public function edit($id)
    {
        return view('post.edit', ['id' => $id]);
    }

    public function update(Request $request, $id)
    {
        $request->validate(['title' => 'required|string|max:255']);
        return redirect()->route('post.index');
    }

    public function destroy($id)
    {
        return redirect()->route('post.index');
    }
}
