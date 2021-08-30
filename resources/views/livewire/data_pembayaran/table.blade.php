<tr>
    <td>{{ $payment->user->name }}</td>
    <td>{{ $payment->user->profile->class->class }}</td>
    <td>{{ $payment->created_at->format("d M Y")  }}</td>
    <td>Rp. {{ number_format($payment->user->profile->class->biaya_spp, 0, ',', '.') }}</td>
    <td>{{ $payment->no_rek  }}</td>
    <td>
        <div class="badge badge-danger">Belum Diverifikasi</div>
    </td>
    <td>
        <button class="btn btn-primary">Lihat Selengkapnya</button>
    </td>
</tr>
