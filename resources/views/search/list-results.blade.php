<ul id="#ul-search-results">
    @if(!$searchData->isEmpty())
    @foreach($searchData as $data)
    <li class=""> 
        <a href="{{ route('product-details',$data['id']) }}">
            <div class="search-img"> <img src="{{ url('images/icon1.png') }}" class="img-responsive" title="" alt="" /> </div>
            <div class="search-content">
                <p class="name">{{ $data['product_name'] .' ' . $data['categories'] }}</p>
                <p class="salts">{{ $data['company'] .',' . $data['salts'] }}</p>
            </div>
        </a>
    </li>
    @endforeach
    <a href="{{ route('home-page-search-full',$query) }}"> View More Results ..</a>
    @else
    <li> 
       No Results Found ..
   </li>
   @endif
</ul>
