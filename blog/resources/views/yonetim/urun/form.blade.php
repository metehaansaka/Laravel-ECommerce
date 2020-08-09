@extends('yonetim.layouts.master')
@section('title','Ürün Form')
@section('head')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')

    <form action="{{route('yonetim.urun.kaydet',$kullanici->id)}}" method="post" enctype="multipart/form-data">
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
            <div class="col-md-6">
                <div class="form-group">
                    <label for="fiyat">Fiyat</label>
                    <input type="text" class="form-control" name="fiyat" id="fiyat" placeholder="Fiyat" value="{{old('fiyat',$kullanici->urun_fiyat)}}">
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
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <label for="kategoriler">Kategoriler</label>
                    <select name="kategoriler[]" id="kategoriler" class="form-control" multiple >
                        @foreach($kategoriler as $kategori)
                            <option value="{{$kategori->id}}" {{collect(old('kategoriler',$kategori_list))->contains($kategori->id) ? 'selected' : ''}}>
                                {{$kategori->kategori_adi}}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        @if($kullanici->detay->urun_resmi != null)
            <img src="/uploads/urunler/{{$kullanici->detay->urun_resmi}}" style="height: 100px; margin-right: 20px;" class="img-thumbnail pull-left">
        @endif
        <div class="form-group">
            <label for="urun_resmi">Resim Seç</label>
            <input type="file" name="urun_resmi" id="urun_resmi">
        </div>
    </form>

@endsection
@section('footer')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script>
        $(function(){
           $('#kategoriler').select2({
               placeholder : "Lütfen Kategori Seçin"
           });
            var options = {
                filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
                filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
                filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
                filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
            };
           CKEDITOR.replace('aciklama',options);
        });
    </script>
@endsection
