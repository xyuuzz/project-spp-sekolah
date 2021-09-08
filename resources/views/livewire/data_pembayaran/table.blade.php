<tr class="text-center">
    <td>{{ $payment->user->name }}</td>
    <td>{{ $payment->user->profile->class->class }}</td>
    <td>{{ $payment->created_at->format("d F Y")  }}</td>
    <td>Rp. {{ number_format($payment->user->profile->class->biaya_spp, 0, ',', '.') }}</td>
    <td>{{ $payment->no_rek  }}</td>
    <td>
        @if($payment->status)
            <div class="badge badge-success">Pembayaran Sah</div>
        @else
            <div class="badge badge-danger">Belum Diverifikasi</div>
        @endif
    </td>
    <td>
        <button wire:click="show('{{$payment->id}}')" wire:loading.remove
                wire:target="show('{{$payment->id}}')" class="btn btn-primary">Lihat Selengkapnya</button>

        <img src="http://gifimage.net/wp-content/uploads/2017/08/loading-animated-gif-1.gif" alt="" width="50" class="d-none" wire:loading.remove.class="d-none" wire:target="show('{{$payment->id}}')">

    </td>
</tr>
