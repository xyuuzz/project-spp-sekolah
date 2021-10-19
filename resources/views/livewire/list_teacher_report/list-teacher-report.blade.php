<div class="container">

    <div class="section-title">
        <h2>Daftar Laporan yang dikirimkan ke Admin</h2>
    </div>

    <div class="mb-4 d-flex justify-content-center">
        {{$list_laporan->links("livewire.partials.pagination")}}
    </div>

    <p class="text-center">
        <img wire:target="nextPage,gotoPage,previousPage" wire:loading.class="d-inline" src="http://gifimage.net/wp-content/uploads/2017/08/loading-animated-gif-1.gif" alt="" width="100" class="d-none">
    </p>


    @include("livewire.partials.alert")
    <div class="row justify-content-center" wire:target="nextPage,gotoPage,previousPage" wire:loading.remove>
        @each("livewire.list_teacher_report.report", $list_laporan, "laporan", "livewire.list_teacher_report.empty")
    </div>


</div>

