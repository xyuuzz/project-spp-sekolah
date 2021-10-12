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

    <div class="container" wire:loading.remove wire:target="nextPage,gotoPage,previousPage" >
        <div class="row justify-content-center">
            @forelse($list_laporan as $laporan)
                <div class="col-lg-4">
                    <div class="card card-margin">
                        <div class="card-header no-border">
                            <h5 class="card-title">Perihal: {{ ucfirst($laporan->about) }}</h5>
                        </div>
                        <div class="card-body pt-0">
                            <div class="widget-49">
                                <div class="widget-49-title-wrapper">
                                    <div class="widget-49-date-primary">
                                        <span class="widget-49-date-day">{{$laporan->created_at->format("d")}}</span>
                                        <span class="widget-49-date-month">{{$laporan->created_at->format("M")}}</span>
                                        <span class="widget-49-date-month">{{$laporan->created_at->format("Y")}}</span>
                                    </div>
                                    <div class="widget-49-meeting-info">
                                        <span class="widget-49-pro-title">{{$laporan->title}}</span>

                                        @if($laporan->report_files->count())
                                            <span class="widget-49-meeting-time">
                                                <span
                                                @if($see_uploaded_file !== $laporan->id)
                                                    wire:click="$set('see_uploaded_file', {{ $laporan->id }})"
                                                    onmouseover="viewHover(this)"
                                                    onmouseout="viewDefault(this, {{$laporan->report_files->count()}})"
                                                @else
                                                    wire:click="$set('see_uploaded_file', 0)"
                                                @endif
                                                    class="text-primary" style="cursor: pointer;">
                                                    @if($see_uploaded_file === $laporan->id)
                                                        Sembunyikan
                                                    @else
                                                        File Terkait: {{$laporan->report_files->count()}}
                                                    @endif
                                                </span>
                                        @else
                                            <span class="widget-49-meeting-time">
                                                File Terkait: {{$laporan->report_files->count()}}
                                        @endif
                                            <small> | </small>
                                            <span class="{{ $laporan->is_seen ? 'text-success' : 'text-danger' }}">
                                                {{ $laporan->is_seen ? 'Dilihat Oleh Admin' : 'Belum Dilihat' }}
                                            </span>
                                        </span>
                                        @if($laporan->reply !== "not yet")
                                            <span class="widget-49-meeting-time text-success">Sudah dibalas
                                                <small> | </small>
                                                @if($see_reply === $laporan->id)
                                                    <span wire:click="$set('see_reply', 0)" class="text-info" style="cursor: pointer;">Sembunyikan</span>
                                                @else
                                                    <span wire:click="$set('see_reply', {{ $laporan->id }})" class="text-primary" style="cursor: pointer;">Lihat Balasan</span>
                                                @endif
                                            </span>
                                        @else
                                            <span class="widget-49-meeting-time text-danger">{{ $laporan->is_seen ? "Tidak dibalas" : "Belum dibalas" }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div wire:loading.remove wire:target="see_reply">
                                    @if($see_reply === $laporan->id)
                                        <h6 class="mt-3">Balasan Admin: </h6>
                                        <p><i>"{!! $laporan->reply !!}"</i></p>
                                    @elseif($see_uploaded_file === $laporan->id)
                                        <h6 class="mt-3">File yang diunggah: </h6>
                                        <ul class="ml-4">
                                            @foreach($laporan->report_files as $file)
                                                <li>{{ explode("-". auth()->id() ."-", $file->file)[1] }}</li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <h6 class="mt-3">Isi Laporan: </h6>
                                        <p><i>"{!! $laporan->content !!}"</i></p>
                                    @endif
                                </div>

                                <p class="text-center">
                                     <img wire:target="see_reply" wire:loading.class="d-inline" src="http://gifimage.net/wp-content/uploads/2017/08/loading-animated-gif-1.gif" alt="" width="100" class="d-none">
                                </p>

                                <div class="widget-49-meeting-action">
{{--                                    <a href="#" class="btn btn-sm btn-flash-border-primary">View All</a>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <h3 class="text-info"><u>Anda Belum pernah Mengirimkan Laporan</u></h3>
            @endforelse
        </div>
    </div>

{{--    <div class="card-deck">--}}
{{--        @forelse($list_laporan as $laporan)--}}
{{--        <div class="card">--}}
{{--            <svg class="bd-placeholder-img card-img-top" width="100%" height="200" xmlns="http://www.w3.org/2000/svg" aria-label="Placeholder: Image cap" preserveAspectRatio="xMidYMid slice" role="img"><title>Placeholder</title><rect width="100%" height="100%" fill="#868e96"/><text x="50%" y="50%" fill="#dee2e6" dy=".3em">Image cap</text></svg>--}}

{{--            <div class="card-body">--}}
{{--                <h5 class="card-title">Card title</h5>--}}
{{--                <p class="card-text">This is a longer card It's a broader card with text below as a natural lead-in to extra content. This content is a little longer. This content is a little bit longer.</p>--}}
{{--                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        @empty--}}
{{--            <div class="card">--}}
{{--                <svg class="bd-placeholder-img card-img-top" width="100%" height="200" xmlns="http://www.w3.org/2000/svg" aria-label="Placeholder: Image cap" preserveAspectRatio="xMidYMid slice" role="img"><title>Placeholder</title><rect width="100%" height="100%" fill="#868e96"/><text x="50%" y="50%" fill="#dee2e6" dy=".3em">Kosong</text></svg>--}}

{{--                <div class="card-body">--}}
{{--                    <h5 class="card-title">Card title</h5>--}}
{{--                    <p class="card-text">This is a longer card It's a broader card with text below as a natural lead-in to extra content. This content is a little longer. This content is a little bit longer.</p>--}}
{{--                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        @endforelse--}}
{{--    </div>--}}
</div>

