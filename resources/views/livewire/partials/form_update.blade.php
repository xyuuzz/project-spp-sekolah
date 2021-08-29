<form wire:submit.prevent="updateTeacher" id="formUpdateTeacher"></form>
<th scope="row">
    <input wire:model.defer="name" type="text" class="form-control" form="formUpdateTeacher">
    @error("name")
        <small class="text-danger">{{$message}}</small>
    @enderror
</th>
<td>
    <select wire:model.defer="gender" class="form-control" form="formUpdateTeacher">
        <option value="Laki-Laki">Laki-Laki</option>
        <option value="Perempuan">Perempuan</option>
    </select>
    @error("gender")
        <small class="text-danger">{{$message}}</small>
    @enderror
</td>
<td>
    <input wire:model.defer="email" type="email" class="form-control" form="formUpdateTeacher">
    @error("email")
        <small class="text-danger">{{$message}}</small>
    @enderror
</td>
{{--peringatan! jika view adl student, maka ada relasi terhadap user, jika view nya teacher, maka akan langsung mengarah ke user--}}
@if($data?->user)
{{--        hal yg dilakukan ketika sedang dalam view student--}}
@else
{{--        hal yg dilakukan ketika sedang dalam view teacher--}}
    <td>
        <select wire:model.defer="class_teacher" class="form-control" form="formUpdateTeacher">
            @foreach(\App\Models\SchoolClass::get() as $class)
                <option value="{{$class->id}}">{{$class->class}}</option>
            @endforeach
        </select>
        @error("class_teacher")
            <small class="text-danger">{{$message}}</small>
        @enderror
    </td>
@endif
<td>
    <button type="submit" class="btn btn-sm btn-outline-success" form="formUpdateTeacher">Sunting</button>
</td>

