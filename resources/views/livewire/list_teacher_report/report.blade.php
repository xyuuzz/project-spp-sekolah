<div class="col-lg-4">
    <div class="card card-margin {{ $laporan->deleted_at ? "bg-warning" : '' }}">
        <div class="card-header no-border">
            <h5 class="card-title" style="width: 300px; white-space:nowrap; overflow: hidden; text-overflow: ellipsis;">Perihal: {{ ucfirst($laporan->about) }}
                @if ( $laporan->deleted_at )
                <small class="text-danger d-block"><b>Laporan Diurungkan</b></small>
                @endif</h5>
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
                        <span class="widget-49-pro-title" style="width: 250px; white-space:wrap; overflow: hidden; text-overflow: ellipsis;">{{ $laporan->title }}</span>

                        @if($laporan->report_files->count())
                            <span class="widget-49-meeting-time">
                                <span
                                @if($this->see_uploaded_file !== $laporan->id)
                                    wire:click="$set('see_uploaded_file', {{ $laporan->id }})"
                                    onmouseover="viewHover(this)"
                                    onmouseout="viewDefault(this, {{$laporan->report_files->count()}})"
                                @else
                                    wire:click="$set('see_uploaded_file', 0)"
                                @endif
                                    class="text-primary" style="cursor: pointer;">
                                    @if($this->see_uploaded_file === $laporan->id)
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
                    @if($this->see_reply === $laporan->id)
                        <h6 class="mt-3">Balasan Admin: </h6>
                        <p><i>"{!! $laporan->reply !!}"</i></p>
                    @elseif($this->see_uploaded_file === $laporan->id)
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
                    @if($laporan->deleted_at)
                        <button wire:target="restoreData({{ $laporan->id }})" wire:loading.class="d-none" wire:click="restoreData({{ $laporan->id }})" class="btn btn-sm btn-success pointer">Kirim Kembali</button>

                        <button wire:target="deleteData({{ $laporan->id }})" wire:loading.class="d-none" wire:click="deleteData({{ $laporan->id }})" class="btn btn-sm btn-danger pointer float-left">Hapus Laporan</button>
                    @else
                        <button wire:target="undoData({{ $laporan->id }})" wire:loading.class="d-none" wire:click="undoData({{ $laporan->id }})" class="btn btn-sm btn-info pointer">Urungkan</button>
                    @endif

                    <img wire:target="undoData({{ $laporan->id }})" wire:loading.class="d-inline" alt="loading gif" width="50" class="d-none"
                    src="http://gifimage.net/wp-content/uploads/2017/08/loading-animated-gif-1.gif">

                    <img wire:target="restoreData({{ $laporan->id }})" wire:loading.class="d-inline" alt="loading gif" width="50" class="d-none" style="margin-top:-10px;"
                    src="https://www.maybelline.com/maybelline/global/img/loading.gif">

                    <img wire:target="deleteData({{ $laporan->id }})" wire:loading.class="d-inline" alt="loading gif" width="50" class="d-none"
                    src="https://www.maybelline.com/maybelline/global/img/loading.gif">
                </div>
            </div>
        </div>
    </div>
</div>
