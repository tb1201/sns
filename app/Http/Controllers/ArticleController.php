<?php

namespace App\Http\Controllers;


use App\Models\Article;
use App\Models\Tag;
use App\Http\Requests\ArticleRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use InterventionImage;

class ArticleController extends Controller
{
    public function __construct()   //ポリシー
    {
        $this->authorizeResource(Article::class, 'article');
    }
    
    public function index()
    {
        //N + 1問題対策
        $articles = Article::all()->sortByDesc('created_at')->load(['user', 'likes', 'tags']); 

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
        if (Storage::missing('public/image')) {
            Storage::makeDirectory('public/image');
        }
        $form = $request->all();
        if (isset($form['image'])) {
            // InterventtionImage ライブラリ
            $image = InterventionImage::make($form['image']);
            $image->orientate();
            $image->resize(
                750,
                null,
                function ($constraint) {
                    // 縦横比を保持したままにする
                    $constraint->aspectRatio();
                    // 小さい画像は大きくしない
                    $constraint->upsize();
                }
            );
            $filename = $form['image']->hashName();
            $filePath = storage_path('app/public/image/');
            $image->save($filePath. $filename);

            $article->image_path = $filename;
        } else {
            $article->image_path = null;
        }
        
        // フォームから送信されてきた_tokenを削除する
        unset($form['_token']);
        // フォームから送信されてきたimageを削除する
        unset($form['image']);
        
        $article->fill($form);
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
        // 送信されてきたフォームデータを格納する
        $article_form = $request->all();

        if ($request->remove == 'true') {
            if (Storage::exists('public/image/'. $article->image_path)) {
                Storage::delete('public/image/'. $article->image_path);
            }
            $article->image_path = null;
        } elseif (isset($article_form['image'])) {
            // InterventtionImage ライブラリ
            $image = InterventionImage::make($article_form['image']);
            $image->orientate();
            $image->resize(
                750,
                null,
                function ($constraint) {
                    // 縦横比を保持したままにする
                    $constraint->aspectRatio();
                    // 小さい画像は大きくしない
                    $constraint->upsize();
                }
            );
            $filename = $article_form['image']->hashName();
            $filePath = storage_path('app/public/image/');
            $image->save($filePath. $filename);

            if (Storage::exists('public/image/'. $article->image_path)) {
                Storage::delete('public/image/'. $article->image_path);
            }
            $article->image_path = $filename;
        }

        unset($article_form['image']);
        unset($article_form['remove']);
        unset($article_form['_token']);

        // 該当するデータを上書きして保存する
        $article->fill($article_form)->save();
        
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
        if (Storage::exists('public/image/'. $article->image_path)) {
            Storage::delete('public/image/'. $article->image_path);
        }
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
