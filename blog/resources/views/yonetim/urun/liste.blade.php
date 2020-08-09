@extends('yonetim.layouts.master')
@section('title','Ürün Paneli')
@section('content')
    <h1 class="sub-header">
        Ürün Yönetim Paneli
    </h1>
    <div class="well">
        <div class="btn-group pull-right" role="group" aria-label="Basic example">
            <a href="{{route('yonetim.urun.yeni')}}" class="btn btn-primary">Ekle</a>
        </div>
        <form action="{{route('yonetim.urun.liste')}}" method="post" class="form-inline">
            {{csrf_field()}}
            <div class="form-group">
                <label for="aranan">Ara</label>
                <input type="text" name="aranan" id="aranan" class="form-control form-control-sm" placeholder="Ürün..." value="{{old('aranan')}}">
            </div>
            <button type="submit" class="btn btn-success btn-sm">Ara</button>
            <a href="{{route('yonetim.urun.liste')}}" class="btn btn-outline-primary btn-sm">Temizle</a>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Resim</th>
                <th>Ürün Adı</th>
                <th>Slug</th>
                <th>Kayıt Tarihi</th>
                <th>Fiyat</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($kullanicilar as $kullanici)
            <tr>
                <td><img style="width: 120px; height: 120px;" src="{{$kullanici->detay->urun_resmi != null ? asset('uploads/urunler/'.$kullanici->detay->urun_resmi) : 'http://via.placeholder.com/120x120?text=resim'}}" alt=""></td>
                <td>{{$kullanici->id}}</td>
                <td>{{$kullanici->urun_adi}}</td>
                <td>{{$kullanici->slug}}</td>
                <td>{{$kullanici->oluşturulma_tarihi}}</td>
                <td>{{ $kullanici->urun_fiyat}}</td>
                <td style="width: 100px">
                    <a href="{{route('yonetim.urun.duzenle',$kullanici->id)}}" class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top" title="Düzenle">
                        <span class="fa fa-pencil"></span>
                    </a>
                    <a href="{{route('yonetim.urun.sil',$kullanici->id)}}" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Sil" onclick="return confirm('Emin misin?')">
                        <span class="fa fa-trash"></span>
                    </a>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pull-right">
            {{$kullanicilar->links()}}
        </div>
    </div>
@endsection
