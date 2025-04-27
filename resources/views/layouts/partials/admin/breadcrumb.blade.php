
@if(count($breadcrumbs) > 0)
    <nav class="mb-4 " >

        <ol class="flex flex-wrap">
            @foreach ($breadcrumbs as $breadcrumb)
                <li class="text-sm leading-tight text-gray-700 {{!$loop ->first ? "pl-2 before:float-left before:pr-2 before:content-['/'] before:text-gray-400 ": ''}}">
                    
  
                    
                    @isset($item['route'])
                        <a href="{{ $breadcrumb['route'] }}" class="opacity-50 hover:opacity-100 transition-opacity duration-300 ease-in-out">
                            {{ $breadcrumb['name'] }}  
                        </a>  
                        
                    @else
                        <span class="opacity-50 hover:opacity-100 transition-opacity duration-300 ease-in-out">
                            {{ $breadcrumb['name'] }}  
                        </span>
                    @endisset

                    
                </li>
            @endforeach


        </ol>

        @if(count($breadcrumbs) > 1)

        <h6 class="text-sm font-semibold text-gray-700 mt-2">
            {{ end ($breadcrumbs)['name'] }}
        </h6>
        @endif
            




        

    </nav>
@endif