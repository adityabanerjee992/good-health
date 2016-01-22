@extends('app')

@section('content')
    <section class="container-1022 main-container salt-details view-more-results">
              <h1 class="main-head"><span class="head-icon"><img src="{{ url('images/element-drug.png') }}" class="img-responsive" alt="" title="" /> </span> Search Results For ({{ $query }}      )</h1>
               
              <div class="medicine-details styled-table">
                    <table class="table table-striped custab">
                        <thead>
                       
                            <tr>
                                <th>medicine</th>
                                <th>company</th>
                                <th>mrp</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                          @if(!$searchData->isEmpty())
                            @foreach($searchData as $data)
                                <tr>
                                    <td><span class="tablet-icon"></span>{{ $data['product_name'] .' ' . $data['categories'] }} </td>
                                    <td>{{ $data['company'] }}</td>
                                
                                    <td>Rs. {{ $data['product_mrp'] }}</td>
                                    <td><a href="{{ route('product-details',$data['id']) }}" class="buynow-style1" /> View More Details</a></td>

                                </tr>
                            @endforeach
                             @else
                                <tr>
                                    <td colspan="3"> 
                                       No Results Found ..
                                   </td>
                                </tr>
                            @endif                            
                        </tbody>
                                
                        </table>
                  <div class="pagination">
                    {!! $searchData->render() !!}

                 {{--      <ul>
                          <li><a href="#" class="pagination-icon"><i class="fa fa-angle-double-left"></i></a></li>
                          <li><a href="#" class="pagination-icon"><i class="fa fa-angle-left"></i></a></li>
                          <li><a href="#" class="page-no active">1</a></li>
                          <li><a href="#" class="page-no">2</a></li>
                          <li><a href="#" class="page-no">3</a></li>
                          <li><a href="#" class="pagination-icon"><i class="fa fa-angle-right"></i></a></li>
                          <li><a href="#" class="pagination-icon"><i class="fa fa-angle-double-right"></i></a></li>
                          
                  --}}     </ul>
                  </div>
              </div>
              
          </section>
@endSection