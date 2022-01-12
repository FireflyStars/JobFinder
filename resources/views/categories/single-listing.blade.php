@if(!empty($categories))
    @php
        $counter = 0;
    @endphp
    @foreach($categories as $category)
        @if($counter == 0)

            <div class="col-lg-12 filters rg">
                <span class="filter-title">Suggested Searches</span>
                <ul>
					<li style="background:#FEF7EC; border-color: #F4A937"><a class="u-on-hover" style="color:#F4A937 !important;" href="#" >All</a></li>
                    @elseif($counter > 8)
                </ul>
            </div>

            <div class="col-lg-4 filters">
                <span class="filter-title">Job categories</span>
                <ul>
                    @php
                    $counter = 0;
                    @endphp
                    @endif
                    <li><a class="u-on-hover" href="{{ url('search-job?q=&category='.$category->id) }}">{{ $category->name }}</a> • {{ ($category->jobs->count() > 0) ? $category->jobs->count() : 'Soon'}}</li>
                    @if($loop->last)
                </ul>
            </div>
        @endif
        @php
            $counter++;
        @endphp
    @endforeach
@endif
