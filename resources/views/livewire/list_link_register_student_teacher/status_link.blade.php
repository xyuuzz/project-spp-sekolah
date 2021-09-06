@if(now() < $link->valid_form)
    <div class="badge badge-secondary">Link Belum dibuka</div>
@elseif(now() > $link->valid_form && now() < $link->valid_until)
    <div class="badge badge-success">Sedang berjalan</div>
@elseif(now() > $link->valid_until)
    <div class="badge badge-danger">Kadaluarsa</div>
@endif
