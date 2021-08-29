<form wire:submit.prevent="update" id="changeClassForm"></form>
<tr class="text-center">
    <th scope="row">
        <input class="form-control" wire:model="class" type="text" placeholder="Contoh Format Class = 7A / XIIA">
        @error("class")
            <small class="text-danger float-left mt-1">{{$message}}</small>
        @enderror
    </th>
    <th scope="row">
        <input class="form-control" wire:model="biaya_spp" type="text">
        @error("biaya_spp")
            <small class="text-danger float-left mt-1">{{$message}}</small>
        @enderror
    </th>
    <td>
        <button wire:click="$set('status', '')" class="btn btn-dribbble mb-2" >Kembali</button>
        <button type="submit" class="btn btn-primary" form="changeClassForm">Sunting</button>
    </td>
</tr>
