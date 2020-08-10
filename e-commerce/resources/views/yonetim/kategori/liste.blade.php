@extends('yonetim.layouts.master')
@section('title','Kategori Paneli')
@section('content')
    <h1 class="sub-header">
        Kategori Yönetim Paneli
    </h1>
    <div class="well">
        <div class="btn-group pull-right" role="group" aria-label="Basic example">
            <a href="{{route('yonetim.kategori.yeni')}}" class="btn btn-primary">Ekle</a>
        </div>
        <form action="{{route('yonetim.kategori.liste')}}" method="post" class="form-inline">
            {{csrf_field()}}
            <div class="form-group">
                <label for="aranan">Ara</label>
                <input type="text" name="aranan" id="aranan" class="form-control form-control-sm" placeholder="İsim..." value="{{old('aranan')}}">
                <label for="ust_id">Üst Kategori</label>
                <select name="ust_id" id="ust_id" class="form-control">
                    <option value="">Seçiniz</option>
                    @foreach($ustKategori as $uk)
                        <option value="{{$uk->id}}" {{old('ust_id') == $uk->id ? 'selected' : ''}}>
                            {{$uk->kategori_adi}}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-success btn-sm">Ara</button>
            <a href="{{route('yonetim.kategori.liste')}}" class="btn btn-outline-primary btn-sm">Temizle</a>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Üst Kategori</th>
                <th>Ad</th>
                <th>Slug</th>
                <th>Kayıt Tarihi</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($kullanicilar as $kullanici)
            <tr>
                <td>{{$kullanici->id}}</td>
                <td>{{$kullanici->ust_kategori->kategori_adi}}</td>
                <td>{{$kullanici->kategori_adi}}</td>
                <td>{{$kullanici->slug}}</td>
                <td>{{$kullanici->oluşturulma_tarihi}}</td>
                <td style="width: 100px">
                    <a href="{{route('yonetim.kategori.duzenle',$kullanici->id)}}" class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top" title="Düzenle">
                        <span class="fa fa-pencil"></span>
                    </a>
                    <a href="{{route('yonetim.kategori.sil',$kullanici->id)}}" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Sil" onclick="return confirm('Emin misin?')">
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
