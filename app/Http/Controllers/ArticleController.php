<?php

namespace App\Http\Controllers;


use App\Models\Article;
use App\Models\Tag;
use App\Http\Requests\ArticleRequest;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function __construct()   //ポリシー
    {
        $this->authorizeResource(Article::class, 'article');
    }
    
    public function index()
    {
        $articles = Article::all()->sortByDesc('created_at');

        return view('articles.index', ['articles' => $articles]);
    }
    
    public function create()
    {
        //タグの自動補完用
        $allTagNames = Tag::all()->map(function ($tag) {
            return ['text' => $tag->name];
        });

        return view('articles.create', [
            'allTagNames' => $allTagNames,
        ]);
    }
    
    public function store(ArticleRequest $request, Article $article)
    {
        $article->fill($request->all());
        $article->user_id = $request->user()->id;
        $article->save(); //テーブルへレコード登録
        
        //タグ作成
        $request->tags->each(function ($tagName) use ($article) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $article->tags()->attach($tag);
        });
        
        return redirect()->route('articles.index');
    }
    
    public function edit(Article $article)
    {
        //タグ更新用
        $tagNames = $article->tags->map(function ($tag) {
            return ['text' => $tag->name];
        });
        
        //タグの自動補完用
        $allTagNames = Tag::all()->map(function ($tag) {
            return ['text' => $tag->name];
        });
        
        return view('articles.edit', [
            'article' => $article,
            'tagNames' => $tagNames,
            'allTagNames' => $allTagNames,
        ]);
    }
    
    public function update(ArticleRequest $request, Article $article)
    {
        $article->fill($request->all())->save();
        
        //タグ更新
        $article->tags()->detach();
        $request->tags->each(function ($tagName) use ($article) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $article->tags()->attach($tag);
        });
        
        return redirect()->route('articles.index');
    }
    
    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('articles.index');
    }
    
    public function show(Article $article)
    {
        return view('articles.show', ['article' => $article]);
    }
    
    //いいねする
    public function like(Request $request, Article $article)
    {
        $article->likes()->detach($request->user()->id);
        $article->likes()->attach($request->user()->id);

        return [
            'id' => $article->id,
            'countLikes' => $article->count_likes,
        ];
    }

    //いいねをはずす
    public function unlike(Request $request, Article $article)
    {
        $article->likes()->detach($request->user()->id);

        return [
            'id' => $article->id,
            'countLikes' => $article->count_likes,
        ];
    }
}
