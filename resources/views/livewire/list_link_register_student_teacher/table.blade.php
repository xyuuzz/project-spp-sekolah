<tr class="text-center">
{{--    {{dd($link->link)}}--}}
    <td>
        <svg class="bi bi-clipboard svg-clipboard" onclick="copas(this, '{{ route("register_student", ["link_register" => $link->link]) }}')" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" style="cursor: pointer;">
            <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z"/>
            <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z"/>
        </svg>
    </td>
    <td>{{strlen($link->link) ? $link->link : "-"}}</td>
    <th scope="row">{{$link->class->class}}</th>
    <td>{{$link->valid_from}}</td>
    <td>{{$link->valid_until}}</td>
    <td>
        @include("livewire.list_link_register_student_teacher.status_link", [$link])
    </td>
    <td>
        <button wire:click="destroyLink('{{$link->created_at}}')" class="btn btn-danger">Hapus</button>
    </td>
</tr>

<script>

</script>
