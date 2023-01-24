<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use InterventionImage;

class UserController extends Controller
{
    public function show(string $name)
    {
        //N + 1問題対策
        $user = User::where('name', $name)->first()->load(['articles.user', 'articles.likes', 'articles.tags']);
        
        //記事投稿日の降順
        $articles = $user->articles->sortByDesc('created_at');
        
        return view('users.show', [
            'user' => $user,
            'articles' => $articles,
        ]);
    }
    
    //プロフィール
    public function edit(string $name)
    {
        $user = User::where('name', $name)->first();
        
        return view('users.profile', ['user' => $user]);
    }
    
    //プロフィール
    public function update(Request $request, string $name)
    {
        //N + 1問題対策
        $user = User::where('name', $name)->first()->load(['articles.user', 'articles.likes', 'articles.tags']);
        // 送信されてきたフォームデータを格納する
        $profile_form = $request->all();

        if (Storage::missing('public/profilePhoto')) {
            Storage::makeDirectory('public/profilePhoto');
        }

        if ($request->remove == 'true') {
            Storage::delete('public/profilePhoto/'. $user->profile_photo);
            $user->profile_photo = null;
        } elseif (isset($profile_form['image'])) {
            // InterventtionImage ライブラリ
            $image = InterventionImage::make($profile_form['image']);
            $image->orientate();
            $image->resize(
                null,
                240,
                function ($constraint) {
                    // 縦横比を保持したままにする
                    $constraint->aspectRatio();
                    // 小さい画像は大きくしない
                    $constraint->upsize();
                }
            );
            $filename = $profile_form['image']->hashName();
            $filePath = storage_path('app/public/profilePhoto/');
            $image->save($filePath. $filename);

            Storage::delete('public/profilePhoto/'. $user->profile_photo);
            $user->profile_photo = $filename;
        }

        unset($profile_form['image']);
        unset($profile_form['remove']);
        unset($profile_form['_token']);

        // 該当するデータを上書きして保存する
        $user->fill(array_merge($profile_form, [ 'password' => Hash::make($profile_form['password']) ]))->save();
        
        return redirect()->route('articles.index');
    }
    
    //いいねした記事一覧用
    public function likes(string $name)
    {
        //N + 1問題対策
        $user = User::where('name', $name)->first()->load(['likes.user', 'likes.likes', 'likes.tags']);

        $articles = $user->likes->sortByDesc('created_at');

        return view('users.likes', [
            'user' => $user,
            'articles' => $articles,
        ]);
    }
    
    //フォロー中一覧
    public function followings(string $name)
    {
        //N + 1問題対策
        $user = User::where('name', $name)->first()->load('followings.followers');

        $followings = $user->followings->sortByDesc('created_at');

        return view('users.followings', [
            'user' => $user,
            'followings' => $followings,
        ]);
    }
    
     //フォロワー一覧
    public function followers(string $name)
    {
        //N + 1問題対策
        $user = User::where('name', $name)->first()->load('followers.followers');

        $followers = $user->followers->sortByDesc('created_at');

        return view('users.followers', [
            'user' => $user,
            'followers' => $followers,
        ]);
    }
    
     public function follow(Request $request, string $name)
    {
        $user = User::where('name', $name)->first();

        if ($user->id === $request->user()->id)
        {
            return abort('404', 'Cannot follow yourself.');
        }

        $request->user()->followings()->detach($user);
        $request->user()->followings()->attach($user);

        return ['name' => $name];
    }
    
    public function unfollow(Request $request, string $name)
    {
        $user = User::where('name', $name)->first();

        if ($user->id === $request->user()->id)
        {
            return abort('404', 'Cannot follow yourself.');
        }

        $request->user()->followings()->detach($user);

        return ['name' => $name];
    }
}
