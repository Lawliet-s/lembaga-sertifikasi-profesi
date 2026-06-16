@extends('layout/client')
@section('judul')
    {{ $berita->title }}
@endsection

@section('berita')
    active
@endsection

@section('css')
<style>
    .sidebar-card {
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        overflow: hidden;
        margin-bottom: 20px;
        transition: box-shadow .2s;
    }
    .sidebar-card:hover {
        box-shadow: 0 4px 12px rgba(0,0,0,.1);
    }
    .sidebar-card img {
        width: 100%;
        height: 180px;
        object-fit: cover;
    }
    .sidebar-card .card-body {
        padding: 12px 15px;
    }
    .sidebar-card .card-body a {
        font-size: 14px;
        font-weight: 600;
        color: #333;
        text-decoration: none;
        display: block;
        line-height: 1.4;
    }
    .sidebar-card .card-body a:hover {
        color: #dc3545;
    }
    .main-article img {
        width: 100%;
        max-height: 450px;
        object-fit: cover;
        border-radius: 8px;
        margin-bottom: 25px;
    }
    .main-article h4 {
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 8px;
    }
    .main-article .date {
        font-size: 14px;
        color: #dc3545;
        margin-bottom: 20px;
    }
    .main-article p {
        font-size: 16px;
        line-height: 1.8;
        color: #444;
    }
</style>
@endsection

@section('isi')
    <div class="single-services py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 order-md-2 mb-4">
                    @foreach ($artikel as $item)
                        <div class="sidebar-card">
                            <div class="card-body">
                                <a href="{{ route('berita_detail', Crypt::encryptString($item->id)) }}">{{ $item->title }}</a>
                            </div>
                            <a href="{{ route('berita_detail', Crypt::encryptString($item->id)) }}">
                                <img src="{{ asset($item->image) }}" alt="{{ $item->title }}">
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="col-md-8 order-md-1 main-article">
                    <img src="{{ asset($berita->image) }}" alt="{{ $berita->title }}">
                    <h4>{{ $berita->title }}</h4>
                    <div class="date">{{ $berita->created_at->format('d/M/Y') }}</div>
                    <p>{!! $berita->body !!}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
