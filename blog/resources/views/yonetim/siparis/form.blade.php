@extends('yonetim.layouts.master')
@section('title','Sipariş Form')
@section('content')

    <form action="{{route('yonetim.siparis.kaydet',!is_null($kullanici->id) ? $kullanici->id : 0)}}" method="post">
        {{csrf_field()}}
        <div class="pull-right">
            <button type="submit" class="btn btn-primary ">{{$kullanici->id > 0 ? "Güncelle" : "Kaydet"}}</button>
        </div>
        <h1 class="sub-header">Sipariş Formu</h1>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="ad_soyad">Ad Soyad</label>
                    <input disabled type="text" class="form-control" name="ad_soyad" id="ad_soyad" placeholder="Ad Soyad" value="{{old('ad_soyad',$kullanici2->sepet->kullanici->ad_soyad)}}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="fiyat">Fiyat</label>
                    <input type="text" class="form-control" name="fiyat" id="fiyat" placeholder="Fiyat" value="{{old('fiyat',$kullanici->fiyat)}}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="durum">Durum</label>
                    <select name="durum" id="durum" class="form-control">
                        <option {{old('durum',$kullanici->durum) == 'Siparişiniz Alındı' ? 'selected' : ''}}>
                            Siparişiniz Alındı
                        </option>
                        <option {{old('durum',$kullanici->durum) == 'Kargoya Verildi' ? 'selected' : ''}}>
                            Kargoya Verildi
                        </option>
                        <option {{old('durum',$kullanici->durum) == 'Teslim Edildi' ? 'selected' : ''}}>
                            Teslim Edildi
                        </option>
                    </select>
                </div>
            </div>
        </div>
        <h3>Sipariş (SP-{{$kullanici->id}})</h3>
        <table class="table table-bordererd table-hover">
            <tr>
                <th colspan="2">Ürün</th>
                <th>Fiyat</th>
                <th>Adet</th>
                <th>Tutar</th>
                <th>Durum</th>
            </tr>
            @foreach($kullanici->sepet->sepet_urunler as $urun)
                <tr>
                    <td> <img style="width: 120px; height: 100px;" src="{{$urun->urun->detay->urun_resmi != null ? asset('uploads/urunler/'.$urun->urun->detay->urun_resmi) : 'http://via.placeholder.com/120x100?text=resim'}}" class="img-responsive"></td>
                    <td>{{$urun->urun->urun_adi}}</td>
                    <td>{{$urun->fiyat }}</td>
                    <td>{{$urun->adet}}</td>
                    <td>{{$urun->fiyat * $urun->adet}}</td>
                    <td>{{$urun->durum}}</td>
                </tr>
            @endforeach
            <tr>
                <th></th>
                <th></th>
                <th>Toplam Tutar (KDV Dahil)</th>
                <td>{{$kullanici->fiyat}}</td>
                <th></th>
            </tr>
            <tr>
                <th></th>
                <th></th>
                <th>Kargo</th>
                <td>Ücretsiz</td>
                <th></th>
            </tr>
            <tr>
                <th></th>
                <th></th>
                <th>Sipariş Toplamı</th>
                <td>{{$kullanici->fiyat}}</td>
                <th></th>
            </tr>

        </table>
    </form>

@endsection
