<li aria-current="page">
    <a class="flex items-center whitespace-nowrap" href="{!! $href !!}">
        <svg class="w-6 h-6 text-gray-400 {{ $index === 1 ? 'hidden' : ''}}" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
        </svg>
        <span class="text-gray-400 ml-1 md:ml-2 text-sm font-medium text-gray-{{ $index === $total ? 700 : 500 }}">{!! $anchortext !!}</span>
    </a>
</li>