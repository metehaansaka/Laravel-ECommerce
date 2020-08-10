@extends('yonetim.layouts.master')
@section('title','Kategori Form')
@section('content')

    <form action="{{route('yonetim.kategori.kaydet',$kullanici->id)}}" method="post">
        {{csrf_field()}}
        <div class="pull-right">
            <button type="submit" class="btn btn-primary ">{{$kullanici->id > 0 ? "Güncelle" : "Kaydet"}}</button>
        </div>
        <h1 class="sub-header">Kategori Formu</h1>
        @include('layouts.partials.errors')
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="ust_id">Üst Kategori</label>
                    <select name="ust_id" id="ust_id" class="form-control">
                        <option value="">Ana Kategori</option>
                        @foreach($kategoriler as $kategori)
                            <option value="{{$kategori->id}}">{{$kategori->kategori_adi}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="ad_soyad">Ad</label>
                    <input type="text" class="form-control" name="kategori_adi" id="kategori_adi" placeholder="Kategori Adi" value="{{old('kategori_adi',$kullanici->kategori_adi)}}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="address">Slug</label>
                    <input type="hidden" name="original_slug" value="{{$kullanici->slug}}">
                    <input type="text" class="form-control" name="slug" id="slug" placeholder="Slug Değeri" value="{{old('slug',$kullanici->slug)}}">
                </div>
            </div>
        </div>
    </form>

@endsection
