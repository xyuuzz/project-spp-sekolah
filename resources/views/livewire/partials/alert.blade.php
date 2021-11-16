@if(session("success"))
    <div class="alert alert-success" role="alert">
        {!! session("success") !!}
    </div>
@elseif(session("failed"))
    <div class="alert alert-danger" role="alert">
        {!! session("failed") !!}
    </div>
@endif
