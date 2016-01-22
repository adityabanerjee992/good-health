@extends('app')

@section('content')
      <section class="container-1022 main-container tablet-details">
          <div class="container-1022 container">
              <div class="row">
                  <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 tablet-detail-left">
                      <h1 class="main-head">{{ $productDetails['product_name'] }}</h1>
                      <div class="tablet-detail-row">
                          <div class="tablet-detail-left-row-left">
                              Company
                          </div>
                          <div class="tablet-detail-left-row-right">
                              {{ $productDetails['company'] }}
                          </div>
                      </div>
                      <div class="tablet-detail-row">
                          <div class="tablet-detail-left-row-left">
                              Salt
                          </div>
                          <div class="tablet-detail-left-row-right">
                             {{ $productDetails['salts'] }}
                          </div>
                      </div>
                      <div class="tablet-detail-row">
                          <div class="tablet-detail-left-row-left">
                              Form
                          </div>
                          <div class="tablet-detail-left-row-right">
                              {{ $productDetails['unit'] }}
                          </div>
                      </div>
                      <div class="tablet-detail-row">
                          <div class="tablet-detail-left-row-left">
                              Packs
                          </div>
                          <div class="tablet-detail-left-row-right">
                              {{ $productDetails['packing'] }}
                          </div>
                      </div>
                  </div>
                  <form action="{{ route('cart-add-product',$productDetails['id']) }}" method="POST">
                  {!! Form::token() !!}
                  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 tablet-detail-right">
{{--                         <div class="tablet-detail-row">
                            <div class="tablet-detail-right-leftblock">
                                variant
                            </div>
                            <div class="tablet-detail-right-rightblock">
                                 <select class="select-style1">
                                      <option>10MG</option>
                                  </select>
                            </div>
                        </div> --}}
	                    <div class="tablet-detail-row">
	                        <div class="tablet-detail-right-leftblock">
	                            quantity
	                        </div>
	                        <div class="tablet-detail-right-rightblock">
	                             <select class="select-style1" name="quantity">
	                                  <option value="1" >1 {{ $productDetails['unit'] }} (s)</option>
	                              </select>
	                        </div>
	                    </div>
                      <div class="product-price">
<!--                          <div class="product-old-price">
                             &nbsp;&nbsp;&nbsp;
                          </div>-->
                          <div class="product-new-price">
                              Rs. {{ $productDetails['product_mrp'] }}
                          </div>
                      </div>
                     
                      <div class="tablet-detail-row tablet-detail-btn">
                          <input type="submit" name="" value="Add to Cart" class="buynow-style1">
                      </div>
                       {{-- <div class="tablet-detail-row special-msg availability-check-text">
                          Check Availability in your area
                      </div>
                      <div class="availability-check">
                          <form>
                              <input type="text" name="" placeholder="enter pin code" required="required" />
                              <input type="submit" name="" value="submit" />
                          </form>
                      </div> --}}
                      <div class="tablet-detail-row special-msg">
                          Save upto 15% on medicine bills!
                      </div>
              </div>
              </form>
          </div>
            <div class="row product-details">
                
              @if($productsOnSameSalts != NULL)
                 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 product-details-right">
                    <div class="medicine-details styled-table">
                        <table class="table table-striped custab">
                            <thead>

                                <tr>
                                    <th>medicine</th>
                                    <th>company</th>
<!--                                    <th>varient</th>-->
                                    <th>packs</th>
<!--                                    <th>substitute</th>-->
<!--                                    <th>quantity</th>-->
                                    <th>mrp</th>
<!--                                    <th>Actions</th>-->
<!--                                    <th>order</th>-->
                                </tr>
                            </thead>
                            <tbody>
                            	@foreach($productsOnSameSalts as $product)
	                                <tr onclick="window.location='{{ route('product-details', $product['id'])}}'">
	                                    <td><span class="tablet-icon"></span>{{ $product['product_name'] }} </td>
	                                    <td>{{ $product['company'] }}</td>
	                                    <td>{{ $product['packing'] .' '. $product['unit'] }}</td>
	<!--                                    <td class="collapse-expand hide-substitute-details">
	                                        <span class="">view</span><i class="fa fa-plus"></i>
	                                    </td>-->
<!--	                                    <td>
	                                        <select class="select-style1">
	                                            <option>1  {{ $product['unit'] }} (s)</option>
	                                        </select>
	                                    </td>-->
	                                    <td> Rs . {{ $product['product_mrp'] }}</td>
<!--	                                    <td><a href="{{ route('product-details', $product['id'])}}"><button class="buynow-style1">View Details</button></a></td>-->
	                                </tr>
	                            @endforeach
                            </tbody>

                            </table>
                      {{-- <div class="pagination">
                      {!! $productsOnSameSalts->render() !!}
                          <ul>
                              <li><a href="#" class="pagination-icon"><i class="fa fa-angle-double-left"></i></a></li>
                              <li><a href="#" class="pagination-icon"><i class="fa fa-angle-left"></i></a></li>
                              <li><a href="#" class="page-no active">1</a></li>
                              <li><a href="#" class="page-no">2</a></li>
                              <li><a href="#" class="page-no">3</a></li>
                              <li><a href="#" class="pagination-icon"><i class="fa fa-angle-right"></i></a></li>
                              <li><a href="#" class="pagination-icon"><i class="fa fa-angle-double-right"></i></a></li>

                          </ul>
                      </div> --}}
                  </div>
                </div>
             
          
          @endif
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 product-details-left">
                    <div class="product-detail-tabs salt-details-tabs">
                          	@if(!$saltDetails->isEmpty())
                          	<ul class="nav nav-tabs" role="tablist"  id="product-details-tabs">
                    		@foreach($saltDetails as $saltDetail)
		                        <!-- Nav tabs -->
		                            <li role="presentation" class=""><a href="#{{ $saltDetail->salt_name }}" aria-controls="{{ $saltDetail->salt_name }}" role="tab" data-toggle="tab">{{ $saltDetail->salt_name }}</a></li>
		                          <!-- Tab panes -->
                    		@endforeach
                          	</ul>
                          
                          <!-- Tab panes -->
                          <div class="tab-content">
                              @foreach($saltDetails as $saltDetail)
                              <div role="tabpanel" class="tab-pane" id="{{ $saltDetail->salt_name }}">
<!--                                  <div class="container-1022 container">-->
                                      <div class="row">
                                          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-4">
                                              <h2 class="font-18 ">SALT INFORMATION</h2>
                                              <p class="color1">Salt Indications</p>
                                              <p class="tab-content-detail">{{ ($saltDetail->salt_indications != NULL)? $saltDetail->salt_indications : 'No information available'  }}</p>
                                              <p class="color1">Salt Dose</p>
                                              <p class="tab-content-detail">
                                                {{ ($saltDetail->salt_dose != NULL)? $saltDetail->salt_dose : 'No information available'  }}
                                              </p>  
                                              <p class="color1">Salt Contraindications</p>
                                              <p class="tab-content-detail">
                                                {{ ($saltDetail->salt_contraindications != NULL)? $saltDetail->salt_contraindications : 'No information available'  }}
                                              </p> 
                                              <p class="color1">Salt Precautions</p>
                                              <p class="tab-content-detail">
                                                {{ ($saltDetail->salt_precautions != NULL)? $saltDetail->salt_precautions : 'No information available'  }}
                                              </p>                                              
                                              <p class="color1">Salt Adverse Effects</p>
                                              <p class="tab-content-detail">
                                                {{ ($saltDetail->salt_adverse_effects != NULL)? $saltDetail->salt_adverse_effects : 'No information available'  }}
                                              </p>                                              
                                              <p class="color1">Salt Storage</p>
                                              <p class="tab-content-detail">
                                                {{ ($saltDetail->salt_storage != NULL)? $saltDetail->salt_storage : 'No information available'  }}
                                              </p>
                                          </div>
<!--                                          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                             <h2 class="font-18 ">Expert advice</h2>
                                             <ul>
                                                 <li>
                                                     It should not be taken by patients who are allergic to azatadine or any of the other ingredients of the tablet.
                                                 </li>
                                                 <li>
                                                     Do not start or continue azatadine, if you have a history of asthma or high blood pressure; glaucoma or increased pressure in the eye.
                                                 </li>
                                                 <li>
                                                     Do not take azatadine, if you have enlargement of the prostate, bladder issues or difficulty in urinating.
                                                 </li>
                                                 <li>
                                                     Avoid using azatadine if you are breast-feeding or pregnant.
                                                 </li>
                                                 <li>
                                                     Do not consume alcohol while taking azatadine.
                                                 </li>
                                                 <li>
                                                     Do not drive or operate machines if you have 
                                                 </li>
                                             </ul>
                                          </div>-->
<!--                                          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                              <h2 class="font-18 ">Expert advice</h2>
                                              <div class="faq">
                                                  <p class="faq-ques">Q. What is azatidine used for? </p>
                                                  <p class="faq-ans">Azatadine is used to treat symptoms of common cold like running nose, sneezing, itching or watery eyes and symptoms of allergy like hives, rashes, itching or other such symptoms.</p>

                                                  <p class="faq-ques">Q. How does azatidine work?</p>
                                                  <p class="faq-ans">
                                                      Azatadine belongs to a class of medication call anti-histamines. Azatadine blocks the release of allergy causing chemicals in the body like histamine.
                                                  </p>

                                                  <p class="faq-ques">Q. Is azatidine safe? Is it safe during pregnancy?</p>
                                                  <p class="faq-ans">
                                                      Azatidine is safe when used at a dosage prescribed for your indication by the doctor. There are studies showing that azatadine may cause adverse effects in fetus or new born. Inform your doctor immediately if you find that you are pregnant while taking the drug and follow the doctor’s instructions clearly as to further use
                                                  </p>
                                              </div>
                                          </div>-->
                                      </div>
<!--                                  </div>-->

                              </div>  
                               @endforeach
                          </div>
                       
                    </div>
                </div>
              @endif

      </section>
      
      
    
    <script>
        
        $('.collapse-expand').on('click',function(){ 
            $(this).toggleClass('hide-substitute-details show-substitute-details');
            $(this).find('span').text(function(i, text){
               
                return text === "view" ? "collapse" : "view";
                
            });
            $(this).find('i').toggleClass('fa-plus fa-minus');
            if($(this).hasClass('show-substitute-details')){
                $(this).parent('tr').after('<tr class="substitute-details"><td colspan="8">dsgdsgdsgd</td></tr>');
            }
            else{
                $(this).parent('tr').next('tr').remove();
            }
           
        });       
        
    </script>

@include('partials.sweatalert', ['title' => 'Item Added To Cart Successfully!','message' => ''])

@endSection