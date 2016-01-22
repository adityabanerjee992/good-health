$(window).load(function(){
// Instantiate the Bloodhound suggestion engine
var products = new Bloodhound({
    datumTokenizer: function (datum) {
        return Bloodhound.tokenizers.whitespace(datum.value);
    },
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    remote: {
            url: '/form-search/%QUERY',
             wildcard: '%QUERY',
            // ajax : {
            //     beforeSend: function(jqXhr, settings){
            //        settings.data = $.param({keyword:  $('#search').val()})
            //     },
            //     type: "POST"

            // },
            filter: function (products) {
                return $.each(products, function (product) {
                    return {
                        // original_title : product.original_title,
                        // release_date: product.release_date,
                        // poster_path : product.poster_path
                        id : product.id,
                        product_name : product.product_name,
                        salts : product.salts,
                        categories : product.categories,
                        company : product.company,
                        product_details_link : product.product_details_link
                    };  
                });
            }
    }
});

// Initialize the Bloodhound suggestion engine
products.initialize();

// Instantiate the Typeahead UI
$('#search').typeahead(null, {
    displayKey: 'product_name',
    minLength: 1,
    limit: 10,
    source: products.ttAdapter(),
    templates: {
        // suggestion: Handlebars.compile('<ul id="ul-search-results"><li> <a href=""><div class="search-img"> <img src="" class="img-responsive" title="" alt="" /> </div><div class="search-content"><p class="name">{{product_name}} &nbsp; {{ categories }}</p><p class="salts">{{company}} &nbsp; {{salts}}</p></div></a></li></ul>'),
        // suggestion: Handlebars.compile('<div><strong>{{original_title}}</strong> – {{company}}</div>'),
        empty: [
                  '<div class="empty-message">',
                    'Unable to find any Medicine that match the current query',
                  '</div>'
                ].join('\n'),
        // suggestion: Handlebars.compile("<p style='padding:6px'><a href='werwerw' ><b>{{product_name}}</b> - Release date {{id}} </a> </p>"),
        // suggestion: Handlebarss.compile   ('<a href="{{ route("product-details",{{id}}) }}"><div class="search-img"> <img src="{{ url("images/icon1.png") }}" class="img-responsive" title="" alt="" /> </div><div class="search-content"><p class="name">{{product_name}} &nbsp; {{ categories }}</p><p class="salts">{{company}} &nbsp; {{salts}}</p></div></a>'),
        suggestion: Handlebars.compile('<div><a href="{{product_details_link}}"><div class="search-img"> <img src="/images/icon1.png" class="img-responsive" title="" alt="" /> </div><div class="search-content"><p class="name">{{product_name}} &nbsp; {{ categories }}</p><p class="salts">{{company}} ,  {{salts}}</p></div></a></div><a href=""> View More Results ..</a>'),
        footer: Handlebars.compile("<center><a href='form-search-full/{{query}}'> View More Results ..</a></center>")
    }   
});

// <ul id="#ul-search-results">
//     <li class=""> 
//         <a href="{{ route('product-details',{{id}}) }}">
//             <div class="search-img"> <img src="{{ url('images/icon1.png') }}" class="img-responsive" title="" alt="" /> </div>
//             <div class="search-content">
//                 <p class="name">{{product_name}} &nbsp; {{ categories }}</p>
//                 <p class="salts">{{company}} &nbsp; {{salts}}</p>
//             </div>
//         </a>
//     </li>
//     // <a href="{{ route('home-page-search-full',{{query}}) }}"> View More Results ..</a>
// </ul>


$('#search').on('typeahead:selected', function (e, datum) {
    window.location.href = datum.product_details_link;
});

$('#search .typeahead').click(function (e, datum) {
    window.location.href = datum.product_details_link;
});

});