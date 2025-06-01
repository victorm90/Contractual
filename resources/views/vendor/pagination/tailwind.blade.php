@if ($paginator->hasPages())
    <ol class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="rounded-l-lg bg-slate-150 dark:bg-navy-500">
                <span class="flex size-8 items-center justify-center rounded-lg text-slate-500 dark:text-navy-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </span>
            </li>
        @else
            <li class="rounded-l-lg bg-slate-150 dark:bg-navy-500">
                <a href="{{ $paginator->previousPageUrl() }}" class="flex size-8 items-center justify-center rounded-lg text-slate-500 transition-colors hover:bg-slate-300 dark:text-navy-200 dark:hover:bg-navy-450">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="bg-slate-150 dark:bg-navy-500">
                            <span class="flex h-8 min-w-[2rem] items-center justify-center rounded-lg bg-primary px-3 leading-tight text-white dark:bg-accent">{{ $page }}</span>
                        </li>
                    @else
                        <li class="bg-slate-150 dark:bg-navy-500">
                            <a href="{{ $url }}" class="flex h-8 min-w-[2rem] items-center justify-center rounded-lg px-3 leading-tight transition-colors hover:bg-slate-300 dark:hover:bg-navy-450">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="rounded-r-lg bg-slate-150 dark:bg-navy-500">
                <a href="{{ $paginator->nextPageUrl() }}" class="flex size-8 items-center justify-center rounded-lg text-slate-500 transition-colors hover:bg-slate-300 dark:text-navy-200 dark:hover:bg-navy-450">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </li>
        @else
            <li class="rounded-r-lg bg-slate-150 dark:bg-navy-500">
                <span class="flex size-8 items-center justify-center rounded-lg text-slate-500 dark:text-navy-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </span>
            </li>
        @endif
    </ol>
@endif