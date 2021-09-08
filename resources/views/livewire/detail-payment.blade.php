<div>
    <div class="section-title">
        <h2>Detail Data Pembayaran</h2>
    </div>

    @include("livewire.partials.alert")

    <div class="card">
        <div class="card-body">
        <p class="text-center">
            <img src="http://gifimage.net/wp-content/uploads/2017/08/loading-animated-gif-1.gif" alt="" width="120" @class(["d-none" => $payment !== null])>
        </p>
        <div @class(["d-none" => $payment === null]) class="card-body">
            <div class="float-lg-right d-block">
                <button wire:click="back" class="btn btn-outline-primary">Kembali</button>
            </div>
            <br>

            <div class="d-lg-flex justify-content mt-3">
{{--                <img src="{{asset("storage/photo_profile_student/$photo_profile")}}" alt="" class="rounded img-thumbnail border" width="300">--}}
                <div class="ml-lg-5 mt-4">
                    <span>Nama Siswa : {{$payment?->user?->name}}</span><br>
                    <span>No. Rekening : {{$payment?->no_rek}}</span><br>
                    <span>Kelas : {{$payment?->user?->profile?->class?->class}}</span><br>
{{--                    <span>No. Absen Siswa : {{$payment?->user?->profile?->no_absen}}</span><br>--}}
                    <span>Email Siswa : {{$payment?->user?->email}}</span><br>
                    <span>No Handphone / WA :
                        <a href="https://wa.me/{{$payment?->user?->profile?->number_phone}}">
                            {{$payment?->user?->profile?->number_phone}}
                        </a>
                    </span><br>
                    <span>Nomor Induk Sekolah : {{$payment?->user?->profile?->nis}}</span><br>
                    <span class="text-bold">Status Pembayaran : <br>
                        @if($payment?->status === 0)
                            <span class="text-danger">Belum Diverifikasi</span>
                        @else
                            <span class="text-success">Pembayaran Sah</span>
                        @endif
                    </span>
                </div>

                <div class="ml-lg-5 mt-4">
                    <span>Bukti Pembayaran: </span><br>
                <img src="https://idebisnis.org/wp-content/uploads/2018/05/cetak-struk-mandiri.jpg" alt="" class="img-thumbail img-fluid" width="300">
                </div>
            </div>

            <div class="mt-5 float-lg-right">
                <button wire:loading.remove wire:target="destroy" wire:click="destroy({{$payment?->id}})" class="btn btn-danger ">Hapus</button>

                <img src="http://gifimage.net/wp-content/uploads/2017/08/loading-animated-gif-1.gif" alt="" width="80" class="d-none" wire:loading.class.remove="d-none" wire:target="destroy">
            </div>

        </div>
    </div>
</div>
