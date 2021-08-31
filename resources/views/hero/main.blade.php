@if(auth()->user()->role === "admin")
    @include("hero.admin")
@elseif(auth()->user()->role === "student")
    @include("hero.student")
@endif
