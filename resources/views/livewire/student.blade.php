<div>
    <section id="bayarspp" class="contact">
        <livewire:bayar-spp :statusPembayaran="$statusPembayaran"/>
{{--        @livewire("bayar-spp", ["statusPembayaran" => $statusPembayaran])--}}
    </section>

    <section id="history-pembayaran" class="testimonials">
        <livewire:history-pembayaran/>
{{--        @livewire("history-pembayaran", ["status" => $status])--}}
    </section>
</div>
