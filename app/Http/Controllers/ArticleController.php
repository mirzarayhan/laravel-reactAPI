<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = \App\Article::all();
 
        return $articles->toJson();
    }
 
    public function store(Request $request)
    {
        $validatedData = $request->validate([
          'title' => 'required',
          'manufacturer' => 'required',
          'year' => 'required',
          'spec' => 'required',
        ]);
 
        $project = \App\Article::create([
          'title' => $validatedData['title'],
          'manufacturer' => $validatedData['manufacturer'],
          'year' => $validatedData['year'],
          'spec' => $validatedData['spec'],
        ]);
 
        $msg = [
            'success' => true,
            'message' => 'Article created successfully!'
        ];
 
        return response()->json($msg);
    }
 
    public function getArticle($id) // for edit and show
    {
        $article = \App\Article::find($id);
 
        return $article->toJson();
    }
 
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'manufacturer' => 'required',
            'year' => 'required',
            'spec' => 'required',
        ]);
 
        $article = \App\Article::find($id);
        $article->title = $validatedData['title'];
        $article->manufacturer = $validatedData['manufacturer'];
        $article->year = $validatedData['year'];
        $article->spec = $validatedData['spec'];
        $article->save();
 
        $msg = [
            'success' => true,
            'message' => 'Article updated successfully'
        ];
 
        return response()->json($msg);
    }
 
    public function delete($id)
    {
        $article = \App\Article::find($id);
        if(!empty($article)){
            $article->delete();
            $msg = [
                'success' => true,
                'message' => 'Article deleted successfully!'
            ];
            return response()->json($msg);
        } else {
            $msg = [
                'success' => false,
                'message' => 'Article deleted failed!'
            ];
            return response()->json($msg);
        }
    }
}
