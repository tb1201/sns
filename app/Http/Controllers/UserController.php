<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use InterventionImage;
use Validator;
use App\Rules\CustomRule;

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
        // 送信されてきたフォームデータを格納する
        $profile_form = $request->all();
        
        //バリデーション
        $validator = Validator::make($profile_form , [
            'name' => ['string', new CustomRule, 'min:3', 'max:16'],
            'email' => ['string', 'email:filter,dns', 'max:255'],
            'self_introduction' => ['string', 'max:160', 'nullable'],
        ]);

        $user = User::where('name', $name)->first();
        //バリデーションの結果がエラーの場合
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        if ($user->name !== $profile_form['name']) {
            if (User::where('name', $profile_form['name'])->first()) {
                return redirect()->back()->withErrors('入力されたユーザー名は、既に登録されています。');
            }
        }
        if ($user->email !== $profile_form['email']) {
            if (User::where('email', $profile_form['email'])->first()) {
                return redirect()->back()->withErrors('入力されたメールアドレスは、既に登録されています。');
            }
        }
        
        if (Storage::missing('public/profilePhoto')) {
            Storage::makeDirectory('public/profilePhoto');
        }

        if ($request->remove == 'true') {
            if (Storage::exists('public/profilePhoto/'. $user->profile_photo)) {
                Storage::delete('public/profilePhoto/'. $user->profile_photo);
            }
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

            if (Storage::exists('public/profilePhoto/'. $user->profile_photo)) {
                Storage::delete('public/profilePhoto/'. $user->profile_photo);
            }
            $user->profile_photo = $filename;
        }

        unset($profile_form['image']);
        unset($profile_form['remove']);
        unset($profile_form['_token']);

        // 該当するデータを上書きして保存する
        $user->fill($profile_form)->save();
        
        return redirect()->route('users.show', [
            'name' => $user->name,
        ]);
    }
    
    //パスワード変更
    public function password(string $name)
    {
        $user = User::where('name', $name)->first();
        
        return view('users.password', ['user' => $user]);
    }
    
    public function passwordUpdate(Request $request, string $name)
    {
        // 送信されてきたフォームデータを格納する
        $password_form = $request->all();
        
        //バリデーション
        $validator = Validator::make($password_form , [
            'password' => ['string', new CustomRule, 'min:8', 'confirmed'],
        ]);

        $user = User::where('name', $name)->first();
        //バリデーションの結果がエラーの場合
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        if (!Hash::check($password_form['current_password'], $user->password)) {
            return redirect()->back()->withErrors('現在のパスワードと入力したパスワードが一致しません。');
        }

        unset($password_form['_token']);

        // 該当するデータを上書きして保存する
        $user->fill(['password' => Hash::make($password_form['password']) ])->save();
        
        return redirect()->route('users.show', [
            'name' => $user->name,
        ]);
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
