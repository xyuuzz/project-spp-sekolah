<tr class="text-center">
    <th scope="row">{{$class->class}}</th>
    <td>Rp. {{ number_format($class->biaya_spp,0,',','.') }}</td>
    <td>
        <button wire:click="edit('{{$class->class}}')" class="btn btn-tertiary mr-2 mb-2">Edit</button>
        <button wire:click="destroy('{{$class->class}}')" class="btn btn-danger">Hapus</button>
    </td>
</tr>
