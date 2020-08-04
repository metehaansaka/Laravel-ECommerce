@extends('yonetim.layouts.master')
@section('title','Kullanıcı Form')
@section('content')

    <form action="{{route('yonetim.kullanici.kaydet',$kullanici->id)}}">
        {{csrf_field()}}
        <div class="pull-right">
            <button type="submit" class="btn btn-primary ">{{$kullanici->id > 0 ? "Güncelle" : "Kaydet"}}</button>
        </div>
        <h1 class="sub-header">Kullanıcı Formu</h1>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="ad_soyad">Ad Soyad</label>
                    <input type="text" class="form-control" name="ad_soyad" id="ad_soyad" placeholder="Ad Soyad" value="{{$kullanici->ad_soyad}}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" class="form-control" name="mail" id="exampleInputEmail1" placeholder="Email" value="{{$kullanici->mail}}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleInputPassword1">Şifre</label>
                    <input type="password" class="form-control" name="sifre" id="exampleInputPassword1" placeholder="Şifre">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="address">Adres</label>
                    <input type="text" class="form-control" name="adres" id="address" placeholder="Adres" value="{{!empty($kullanici->kullaniciDetay) ? $kullanici->kullaniciDetay->adres : ""}}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="telefon">Telefon</label>
                    <input type="text" class="form-control" name="telefon" id="telefon" placeholder="Telefon" value="{{!empty($kullanici->kullaniciDetay) ? $kullanici->kullaniciDetay->telefon : ""}}">
                </div>
            </div>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="yonetici" value="1" {{$kullanici->yonetici == 1 ? "checked" : ""}}> Yönetici
            </label>
        </div>
    </form>

@endsection
