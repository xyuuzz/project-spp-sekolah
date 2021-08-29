<tr>
{{--peringatan! jika view adl student, maka ada relasi terhadap user, jika view nya teacher, maka akan langsung mengarah ke user--}}
    @if($data?->user)
        <td>
            <img src="http://4.bp.blogspot.com/_N_mOB63qPaE/TUPPcgtg46I/AAAAAAAASK8/E2M0crA1XJs/s1600/mountain%252Bwallpaper-13.jpg" alt="" class="rounded img-thumbnail" width="100">
        </td>
        <th scope="row">
{{--            kanan jika model di paginate, kiri jika sedang dalam mode searching--}}
            {{$data?->user?->name ?? $data->name}}
        </th>
        <td>
{{--            kanan jika model di paginate, kiri jika sedang dalam mode searching--}}
            {{$data?->user?->gender ?? $data->gender}}
        </td>
        <td>
{{--            kanan jika model di paginate, kiri jika sedang dalam mode searching--}}
            {{$data?->user?->email ?? $data->email}}
        </td>
        <td>
{{--            kanan jika model di paginate, kiri jika sedang dalam mode searching--}}
            {{ is_string($data->class) ? $data->class : $data->class->class}}
        </td>
        <td>
            {{$data->NIS}}
        </td>
        <td>
            <button wire:click="showStudent('{{$data->user->slug}}')" class="btn btn-sm btn-outline-info">Lihat Selengkapnya</button>
        </td>
    @else
        @if($this->slug === $data->slug)
            @include("livewire.partials.form_update")
{{--            <livewire:update-teacher :slug="$data['slug']"/>--}}
        @else
            <th scope="row">{{$data->name}}</th>
            <td>{{$data->gender}}</td>
            <td>{{$data->email}}</td>
            <td>
{{--            kanan jika model di paginate, kiri jika sedang dalam mode searching--}}
                {{$data->class_teacher[0]->class}}
            </td>
            <td>
                <button wire:click="destroyTeacher('{{$data->slug}}')" class="btn btn-sm btn-outline-danger">Hapus</button>
                <button wire:click="editTeacher('{{$data->slug}}')" class="btn btn-sm btn-outline-info">Sunting</button>
            </td>
        @endif
    @endif
</tr>