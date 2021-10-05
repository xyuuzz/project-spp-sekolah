@can("is_admin")
    @include("hero.admin")
@endcan

@can("is_student")
    @include("hero.student")
@endcan

@can("is_teacher")
    @include("hero.teacher");
@endcan
