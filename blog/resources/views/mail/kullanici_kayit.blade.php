<h1>{{config('app.name')}}</h1>
<p>Merhaba {{$kullanici->ad_soyad}} kayıdınızı tamamlamak için
    <a href="{{config('app.url')}}\kullanici\aktiflestir\{{$kullanici->aktivasyon}}">linke tıklayın</a></p>
