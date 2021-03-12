@if ($paginator->hasPages())
    <div class="flex justify-between items-center my-2">
        <div class="text-sm text-gray-700 leading-5">
            Showing {{ $paginator->firstItem() }} to {{ $paginator->lastItem() }} of {{ $paginator->total() }} results
        </div>
        <div class="flex">
            @if (!$paginator->onFirstPage())
                {{-- First Page Link --}}
                <a class="px-4 py-2 rounded-tl-md rounded-bl-md bg-gray-300 text-gray-500 font-bold text-center flex items-center hover:bg-gray-500 hover:text-gray-200 cursor-pointer"
                    wire:click="gotoPage(1)">
                    <div class="w-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
                        </svg>
                    </div>
                </a>
                @if($paginator->currentPage() > 2)
                {{-- Previous Page Link --}}
                <a class="px-4 py-2 bg-gray-300 text-gray-500 font-bold text-center flex items-center hover:bg-gray-500 hover:text-gray-200 cursor-pointer"
                    wire:click="previousPage">
                    <div class="w-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </div>
                </a>
                @endif
            @endif

            <!-- Pagination Elements -->
            @foreach ($elements as $element)
                <!-- Array Of Links -->
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        <!--  Use three dots when current page is greater than 3.  -->
                        @if ($paginator->currentPage() > 3 && $page === 2)
                            <div class="">
                                <span class="font-bold">&nbsp;</span>
                            </div>
                        @endif

                        <!--  Show active page two pages before and after it.  -->
                        @if ($page == $paginator->currentPage())
                            <span class="px-4 py-2 bg-gray-400 text-white font-bold text-center hover:bg-gray-600 cursor-pointer">{{ $page }}</span>
                        @elseif ($page === $paginator->currentPage() + 1 || $page === $paginator->currentPage() + 2 || $page === $paginator->currentPage() - 1 || $page === $paginator->currentPage() - 2)
                            <a class="px-4 py-2 bg-gray-300 text-gray-700 text-center hover:bg-gray-500 hover:text-gray-200 cursor-pointer" wire:click="gotoPage({{$page}})">{{ $page }}</a>
                        @endif

                        <!--  Use three dots when current page is away from end.  -->
                        @if ($paginator->currentPage() < $paginator->lastPage() - 2  && $page === $paginator->lastPage() - 1)
                            <div class="">
                                <span class="font-bold">&nbsp;</span>
                            </div>
                        @endif
                    @endforeach
                @endif
            @endforeach
            
            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                @if($paginator->lastPage() - $paginator->currentPage() >= 2)
                <a class="px-4 py-2 bg-gray-300 text-gray-500 font-bold text-center flex items-center hover:bg-gray-500 hover:text-gray-200 cursor-pointer"
                    wire:click="nextPage">
                        <div class="w-4">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                    </a>
                @endif
                    <a class="px-4 py-2 rounded-tr-md rounded-br-md bg-gray-300 text-gray-500 font-bold text-center flex items-center hover:bg-gray-500 hover:text-gray-200 cursor-pointer"
                    wire:click="gotoPage({{ $paginator->lastPage() }})">
                        <div class="w-4">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                            </svg>
                        </div>
                    </a>
            @endif
        </div>
    </div>
@endif