@extends('yonetim.layouts.master')
@section('title','Ürün Form')
@section('content')

    <form action="{{route('yonetim.urun.kaydet',$kullanici->id)}}" method="post">
        {{csrf_field()}}
        <div class="pull-right">
            <button type="submit" class="btn btn-primary ">{{$kullanici->id > 0 ? "Güncelle" : "Kaydet"}}</button>
        </div>
        <h1 class="sub-header">Ürün Formu</h1>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="ad">Ürün Adı</label>
                    <input type="text" class="form-control" name="ad" id="ad" placeholder="Ürün Adı" value="{{old('ad',$kullanici->urun_adi)}}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="hidden" name="original_slug" value="{{$kullanici->slug}}">
                    <input type="text" class="form-control" name="slug" id="slug" placeholder="Slug" value="{{old('slug',$kullanici->slug)}}">
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group">
                    <label for="aciklama">Açıklama</label>
                    <textarea class="form-control" rows="5" name="aciklama" id="aciklama" placeholder="Açıklama" >{{old('aciklama',$kullanici->urun_aciklama)}} </textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="fiyat">Fiyat</label>
                    <input type="text" class="form-control" name="fiyat" id="fiyat" placeholder="Açıklama" value="{{old('fiyat',$kullanici->urun_fiyat)}}">
                </div>
            </div>
        </div>
        <div class="checkbox">
            <label>
                <input type="hidden" name="slider" value="0">
                <input type="checkbox" name="slider"  value="1" {{old('slider',$kullanici->detay->slider) == 1 ? "checked" : ""}}>
                Slider'da Göster
            </label>
            <label>
                <input type="hidden" name="one_cikan" value="0">
                <input type="checkbox" name="one_cikan"  value="1" {{old('one_cikan',$kullanici->detay->one_cikan) == 1 ? "checked" : ""}}>
                Öne Çıkanlar'da Göster
            </label>
            <label>
                <input type="hidden" name="cok_satan" value="0">
                <input type="checkbox" name="cok_satan"  value="1" {{old('cok_satan',$kullanici->detay->cok_satan) == 1 ? "checked" : ""}}>
                Çok Satanlar'da Göster
            </label>
            <label>
                <input type="hidden" name="indirimli" value="0">
                <input type="checkbox" name="indirimli"  value="1" {{old('indirim',$kullanici->detay->indirimli) == 1 ? "checked" : ""}}>
                İndirimler'de Göster
            </label>
        </div>
    </form>

@endsection
