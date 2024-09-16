<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogsAndNews;
use Illuminate\Support\Facades\DB;
use Auth;

class BlogsAndNewsController extends Controller
{
    public function blogsAndNews()
    {
        return view('pages.admin.blogs_and_news');
    }

    public function getBlogsAndNews(Request $request)
    {
        $blogsAndNews = BlogsAndNews::query();
        
        if ($request->has('search') && !empty($request->input('search')['value'])) {
            $search = $request->input('search')['value'];
            $blogsAndNews->where(function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%');
            });
        }

        return datatables()->of($blogsAndNews)
            ->addColumn('action', function ($item) {
                return '<a href="#" class="btn btn-sm btn-info edit" data-id="'.$item->id.'">Edit</a>
                        <a href="#" class="btn btn-sm btn-danger delete" data-id="'.$item->id.'">Delete</a>';
            })
            ->toJson();
    }

    public function store(Request $request)
    {
        if ($request->is_default == 1) {
            $item = BlogsAndNews::where('is_default', 1)->first();

            if ($item){
                $item->is_default = 0;
                $item->save();
            }
        }

        $item = BlogsAndNews::create([
            'title' => $request->title,
            'blogs_news' => $request->blogs_news,
            'is_default' => $request->is_default,
        ]);
        return response()->json(['success' => 'Item created successfully']);
    }

    public function edit($id)
    {
        $item = BlogsAndNews::find($id);
        return response()->json($item);
    }

    public function update(Request $request, $id)
    {
        if ($request->is_default == 1) {
            $item = BlogsAndNews::where('is_default', 1)->first();

            if ($item){
                $item->is_default = 0;
                $item->save();
            }
        }

        $item = BlogsAndNews::find($id);
        $item->title = $request->title;
        $item->blogs_news = $request->blogs_news;
        $item->is_default = $request->is_default;
        $item->save();
        return response()->json(['success' => 'Item updated successfully']);
    }

    public function destroy($id)
    {
        $item = BlogsAndNews::find($id);
        $item->delete();
        return response()->json(['success' => 'Item deleted successfully']);
    }

}
