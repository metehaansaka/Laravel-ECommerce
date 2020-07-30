@extends('layouts.master')
@section('title','Ödeme')
@section('content')
    <div class="container">
        <div class="bg-content">
            <h2>Ödeme</h2>
            <form action="{{route('odemeYap')}}" method="post">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-md-5">
                        <h3>Ödeme Bilgileri</h3>
                        <div class="form-group">
                            <label for="kartno">Kredi Kartı Numarası</label>
                            <input type="text" class="form-control kredikarti" id="kartno" name="kart_numarasi" style="font-size:20px;" required>
                        </div>
                        <div class="form-group">
                            <label for="cardexpiredatemonth">Son Kullanma Tarihi</label>
                            <div class="row">
                                <div class="col-md-6">
                                    Ay
                                    <select name="son_kullanma_ay" id="cardexpiredatemonth" class="form-control" required>
                                        <option>1</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    Yıl
                                    <select name="son_kullanma_yil" class="form-control" required>
                                        <option>2017</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="cardcvv2">CVV (Güvenlik Numarası)</label>
                            <div class="row">
                                <div class="col-md-4">
                                    <input type="text" class="form-control kredikarti_cvv" name="guvenlik_no" id="cardcvv2" required>
                                </div>
                            </div>
                        </div>
                        <form>
                            <div class="form-group">
                                <div class="checkbox">
                                    <label><input type="checkbox" checked> Ön bilgilendirme formunu okudum ve kabul ediyorum.</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="checkbox">
                                    <label><input type="checkbox" checked> Mesafeli satış sözleşmesini okudum ve kabul ediyorum.</label>
                                </div>
                            </div>
                        </form>
                        <button type="submit" class="btn btn-success btn-lg">Ödeme Yap</button>
                    </div>
                    <div class="col-md-7">
                        <h4>Ödenecek Tutar</h4>
                        <span class="price">{{Cart::getTotal()}}<small>TL</small></span>

                        <h4>Ad Soyad</h4>
                        <p>{{auth()->user()->ad_soyad}}</p>
                        <h4>Adres</h4>
                        <input type="text" name="adres" value="{{$kullanici->adres}}">

                        <h4>Telefon</h4>
                        <input type="text" name="telefon" value="{{$kullanici->telefon}}">
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection
@section('footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.js"></script>
    <script>
        $('.kredikarti').mask('0000-0000-0000-0000', { placeholder: "____-____-____-____" });
        $('.kredikarti_cvv').mask('000', { placeholder: "___" });
        $('.telefon').mask('(000) 000-00-00', { placeholder: "(___) ___-__-__" });
    </script>
@endsection
