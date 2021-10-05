<button wire:click="$set('choiceType', 'name')" class="btn {{$choiceType === "name" ? "btn-tertiary" : 'btn-primary'}}">Nama</button>
<button wire:click="$set('choiceType', 'email')" class="btn ml-2 {{$choiceType === "email" ? "btn-tertiary" : 'btn-primary'}}">Email</button>

@can("is_admin")
    <button wire:click="$set('choiceType', 'class')" class="btn ml-2 {{$choiceType === "class" ? "btn-tertiary" : 'btn-primary'}}">Kelas</button>
    <button wire:click="$set('choiceType', 'nis')" @class([
    "d-none" => $status === "teacher",
    "btn",
    "ml-2",
    "btn-primary" => $choiceType !== "nis",
    "btn-tertiary" => $choiceType === "nis"
    ])>
    NIS
    </button>
@endcan
