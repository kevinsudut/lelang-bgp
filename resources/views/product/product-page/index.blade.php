@inject('ConvertImage', '\App\Helpers\Image\ConvertImage')
@inject('CarbonFormater', '\App\Helpers\DateTime\CarbonFormater')

@extends('layouts.app')

@section('content')
    <div class="container-fluid" style="padding: 2em 4em">
        <div class="row">
            <div class="col-md-4">
                <img alt="product" src="https://macstore.id/konten/uploads/2020/12/mbp-silver-gallery2-202011_GEO_US.jpeg" style="width: 100%"/>
            </div>
            <div class="col-md-8">
                <h3>
                    Macbook Pro M1
                </h3>
                <p>
                Garansi Resmi Apple Indonesia 1 Tahun

                100% Original Baru dan Segel Pabrik Apple

                Model Number : MYD92ID/A (GREY) dan MYDC2ID/A (SILVER)

                Untuk Apple Macbook Resmi Indonesia memiliki Model Number ID/A Untuk Region / Negara indonesia dan dapat di klaim Garansi di Seluruh Apple Resmi di Indonesia iBox / Mitracare / Story-i / QCD / Apple Resmi lainnya

                Spesifikasi :

                Memori
                8 GB
                Penyimpanan
                512 GB
                Prosesor
                Apple M1 Chip (CPU 8-Core, GPU 8-Core)
                Ukuran Layar
                13.3 inci
                Tipe Layar
                Layar dengan lampu latar LED 13,3 inci (diagonal) dengan teknologi IPS
                Layar Retina
                2560 x 1600 piksel
                Kecerahan 500 nit
                Warna luas (P3)
                Teknologi True Tone
                </p>
                <h4>Current Bid: Rp 10.000.000,- by Ind** Ke****</h4>
                <h5>Time left: 6d 10h | Sun, 11:30am</h5>
                <br/>
                <form action="#">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <input type="text" class="form-control" id="inputBid" placeholder="e.g. 10000"/>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary">
                                Place Bid
                            </button>
                        </div>
                    </div>
                </form>
                <br/>
                <p>
                    1000 bids
                </p>
            </div>
        </div>
    </div>

@endsection
