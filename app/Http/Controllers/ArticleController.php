<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Article;
use App\Http\Resources\Article as ArticleResource;
use DB;
use Helper;
use DeviceTrust;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
            //  Get articles
            $articles = DB::table('articles as a')
                            ->select('a.id','a.user_id','a.image','a.title','a.body','a.created_at','u.name')
                            ->leftjoin('users as u', 'a.user_id','=','u.id');
                           
        if($request->search) {
            $articles = $articles->where('a.title','LIKE','%'.$request->search.'%');
        }
            $articles = $articles->orderBy('a.id','DESC')
                                          ->paginate(DeviceTrust::settings('FRONTEND_PAGINATION'));

        // Return collection of articles as a resource
        return ArticleResource::collection($articles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Create || Update
        $article = $request->isMethod('put') ? Article::findOrFail($request->article_id) : new Article;

        if($request->hasFile('image')) {
            $file = $request->file('image');
            $path = 'uploads/articles/';
            $fileName = date('Y-m-d-H-i-s').'.'.$file->getClientOriginalExtension();
            $file->move(public_path().'/'.$path,$fileName);
            $article->image = $path.$fileName;
        }

        $article->user_id = $request->input('user_id');
        $article->title = $request->input('title');
        $article->body = $request->input('body');

        if($article->save()) {
            return new ArticleResource($article);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Get article
        $article = DB::table('articles as a')
                            ->select('a.id','a.user_id','a.image','a.title','a.body','a.created_at','u.name')
                            ->leftjoin('users as u', 'a.user_id','=','u.id')
                            ->where('a.id',$id)
                            ->first();

        // Return single article as a resource
        return new ArticleResource($article);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Get article
        $article = Article::findOrFail($id);

        if($article->delete()) {
           return new ArticleResource($article);
        }
    }
}
