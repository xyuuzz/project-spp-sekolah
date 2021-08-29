<div class="row mt-3 mb-2">
    @if($paginator->hasPages())
    <div class="col-md-12">
        <div class="block-27">
            <ul>
                @if(! $paginator->onFirstPage())
                    <li>
                        <a wire:click="previousPage" style="cursor: pointer;">&lt;</a>
                    </li>
                @endif

                @foreach ($elements as $element)
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
{{--                            untuk el yang aktif--}}
                            @if ($page == $paginator->currentPage())
                                <li wire:key="paginator-page-{{ $page }}" class="active" aria-current="page" style="cursor: pointer;">
                                    <span>{{ $page }}</span>
                                </li>
                            @else
{{--                                untuk el yang pasif / tidak aktif--}}
                                <li wire:key="paginator-page-{{ $page }}" aria-current="page" style="cursor: pointer;">
                                    <span wire:click="gotoPage({{$page}})">{{$page}}</span>
                                </li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                @if($paginator->hasMorePages())
                    <li>
                        <a wire:click="nextPage" style="cursor: pointer;">&gt;</a>
                    </li>
                @endif

            </ul>
        </div>
    </div>
    @endif
</div>
