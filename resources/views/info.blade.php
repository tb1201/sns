@extends('app')

@section('title', 'インフォメーション')

@section('content')
    @include('nav')
    <div class="container-fluid py-5 p-0">
        <div class="info-img-size mb-5">
            <img src="{{ secure_asset('img/iwate.jpg') }}">
        </div>
        <p>岩手県盛岡市は、2020年のコーヒー消費量が全国5位。個人経営の喫茶店、コーヒー販売店が多い。<br>
            岩手県内のコーヒー販売店舗を知るための口コミが纏まったサイトがあればいいなと思い、<br>
            おすすめのカフェ、喫茶店などを投稿できるsnsを作成しました。
        </p>
    </div>
@endsection