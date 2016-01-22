@extends('app')

@section('content')

<!-- PAGE BREADCRUMB -->
<section class="page-breadcrumb">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<ol class="breadcrumb my-breadcrumb">
					<li><a href="{{ url('') }}">HOME</a><span class="bread-sr">&raquo;</span></li>
					<li>DRUGS BY {{$class}}<span class="bread-sr">&raquo;</span></li>
					<li class="active">{{ strtoupper($category) }} <span class="bread-sr">&raquo;</span></li>
					<li class="active">{{ strtoupper($subCategory) }}</li>
				</ol>
			</div>
		</div>
	</div>
</section> <!-- /.page-breadcrumb -->


<!-- SMALL SEARCH BOX -->
<section class="small-search-box">
	<div class="container">
		<div class="row">
			<div class="col-md-2"></div>

		    <div class="col-md-8 col-xs-12">
		    	<div id="my-search-bar">
					<p class="my-search-p my-search-p-sml">
						<span class="fa fa-map-marker in-check-poin-icon"></span> 
						<input type="text" placeholder="Check picode" class="ininput ininput1"> 
						<span class="input-vert-bdr"></span> 
						<input type="text" placeholder="SEARCH YOUR MEDICINE / OTC PRODUCTS" class="ininput ininput2"> 
						<span class="fa fa-search in-search-icon in-search-icon-sml"></span>
					</p>
				</div> <!-- /.my-search-bar -->
		    </div> <!-- /.col-md-10 -->
	    
			<div class="col-md-2"></div>
		</div> <!-- /.row -->
	</div> <!-- /.container -->
</section> <!-- /.small-search-box -->


<!-- ORDER FORM -->
<section class="order-form">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<h2 class="order-form-title text-center">{{ $subCategory }}</h2>
				<h3 class="order-form-sub-title text-center">AVAILABLE MEDICINE</h3>

				<table class="table table-responsive table-bordered salt-dtls-table my-table">
					<tr>
						<th>Medicine</th>
						<th>Company</th>
						<th>Variant</th>
						<th>Packs</th>
						<th>Substitutes</th>
						<th>Quantity</th>
						<th>MRP</th>
						<th class="">Order</th>
					</tr>

					<tbody>
						<tr>
							<td>
								<p><img src="{{ url('images/small-drug.png') }}" alt="Small Drugs" class="small-drug"> Histeeze1</p>
							</td>
							<td><p>Histeeze1</p></td>
							<td>
								<select class="form-control">
									<option>10MG</option>
									<option>10MG</option>
									<option>10MG</option>
									<option>10MG</option>
								</select>
							</td>
							<td><p>10 Tablets</p></td>
							<td class="clsp tbl-view"><p>Collapse -</p></td>
							<td>
								<select class="form-control">
									<option> 1Strip(s)</option>
									<option> 1Strip(s)</option>
									<option> 1Strip(s)</option>
									<option> 1Strip(s)</option>
								</select>
							</td>
							<td><p>Rs. 12.51</p></td>
							<td><a href="{{ url('cart') }}"><button class="buy-button">Buy Now</button></a></td>
						</tr> <!-- /tr -->

						<tr class="tbl-txt-tr tbl-data">
							<td></td>
							<td></td>
							<td></td>
							<td><p class="collapse out sub-histeze" id="collapseme" >Substitutes for Histeeze1</p></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>

						<tr class="tbl-rw-bg tbl-rw-bdrup">
							<td>
								<p><img src="{{ url('images/small-drug.png') }}" alt="Small Drugs" class="small-drug"> Alerzole1</p>
							</td>
							<td><p>Alerzole1</p></td>
							<td>
								<select class="form-control">
									<option>10MG</option>
									<option>10MG</option>
									<option>10MG</option>
									<option>10MG</option>
								</select>
							</td>
							<td><p>10 Tablets</p></td>
							<td class=""><p>View +</p></td>
							<td>
								<select class="form-control">
									<option> 1Strip(s)</option>
									<option> 1Strip(s)</option>
									<option> 1Strip(s)</option>
									<option> 1Strip(s)</option>
								</select>
							</td>
							<td><p>Rs. 12.51</p></td>
							<td><button class="buy-button out-stock-btn">Out of stock</button></td>
						</tr> <!-- /tr -->

						<tr class="tbl-rw-bg tbl-rw-bdr">
							<td>
								<p><img src="{{ url('images/small-drug.png') }}" alt="Small Drugs" class="small-drug"> Acipax1</p>
							</td>
							<td><p>Acipax1</p></td>
							<td>
								<select class="form-control">
									<option>10MG</option>
									<option>10MG</option>
									<option>10MG</option>
									<option>10MG</option>
								</select>
							</td>
							<td><p>10 Tablets</p></td>
							<td class="clsp tbl-view"><p>View +</p></td>
							<td>
								<select class="form-control">
									<option> 1Strip(s)</option>
									<option> 1Strip(s)</option>
									<option> 1Strip(s)</option>
									<option> 1Strip(s)</option>
								</select>
							</td>
							<td><p>Rs. 12.51</p></td>
							<td><a href="{{ url('cart') }}"><button class="buy-button">Buy Now</button></a></td>
						</tr> <!-- /tr -->

						<tr>
							<td>
								<p><img src="{{ url('images/small-drug.png') }}" alt="Small Drugs" class="small-drug"> Astelong1</p>
							</td>
							<td><p>Astelong1</p></td>
							<td>
								<select class="form-control">
									<option>10MG</option>
									<option>10MG</option>
									<option>10MG</option>
									<option>10MG</option>
								</select>
							</td>
							<td><p>10 Tablets</p></td>
							<td class="clsp tbl-view"><p>View +</p></td>
							<td>
								<select class="form-control">
									<option> 1Strip(s)</option>
									<option> 1Strip(s)</option>
									<option> 1Strip(s)</option>
									<option> 1Strip(s)</option>
								</select>
							</td>
							<td><p>Rs. 12.51</p></td>
							<td><a href="{{ url('cart') }}"><button class="buy-button">Buy Now</button></a></td>
						</tr> <!-- /tr -->

						<tr>
							<td>
								<p><img src="{{ url('images/small-drug.png') }}" alt="Small Drugs" class="small-drug">Stemiz2</p>
							</td>
							<td><p>Stemiz2</p></td>
							<td>
								<select class="form-control">
									<option>10MG</option>
									<option>10MG</option>
									<option>10MG</option>
									<option>10MG</option>
								</select>
							</td>
							<td><p>10 Tablets</p></td>
							<td class="clsp tbl-view"><p>View +</p></td>
							<td>
								<select class="form-control">
									<option> 1Strip(s)</option>
									<option> 1Strip(s)</option>
									<option> 1Strip(s)</option>
									<option> 1Strip(s)</option>
								</select>
							</td>
							<td><p>Rs. 12.51</p></td>
							<td><a href="{{ url('cart') }}"><button class="buy-button">Buy Now</button></a></td>
						</tr> <!-- /tr -->

						<tr>
							<td>
								<p><img src="{{ url('images/small-drug.png') }}" alt="Small Drugs" class="small-drug"> Acipax1</p>
							</td>
							<td><p>Acipax1</p></td>
							<td>
								<select class="form-control">
									<option>10MG</option>
									<option>10MG</option>
									<option>10MG</option>
									<option>10MG</option>
								</select>
							</td>
							<td><p>10 Tablets</p></td>
							<td class="clsp tbl-view"><p>View +</p></td>
							<td>
								<select class="form-control">
									<option> 1Strip(s)</option>
									<option> 1Strip(s)</option>
									<option> 1Strip(s)</option>
									<option> 1Strip(s)</option>
								</select>
							</td>
							<td><p>Rs. 12.51</p></td>
							<td><a href="{{ url('cart') }}"><button class="buy-button">Buy Now</button></a></td>
						</tr> <!-- /tr -->

						<tr>
							<td>
								<p><img src="{{ url('images/small-drug.png') }}" alt="Small Drugs" class="small-drug"> Astelong1</p>
							</td>
							<td><p>Astelong1</p></td>
							<td>
								<select class="form-control">
									<option>10MG</option>
									<option>10MG</option>
									<option>10MG</option>
									<option>10MG</option>
								</select>
							</td>
							<td><p>10 Tablets</p></td>
							<td class="clsp tbl-view"><p>View +</p></td>
							<td>
								<select class="form-control">
									<option> 1Strip(s)</option>
									<option> 1Strip(s)</option>
									<option> 1Strip(s)</option>
									<option> 1Strip(s)</option>
								</select>
							</td>
							<td><p>Rs. 12.51</p></td>
							<td><a href="{{ url('cart') }}"><button class="buy-button">Buy Now</button></a></td>
						</tr> <!-- /tr -->

						<tr>
							<td>
								<p><img src="{{ url('images/small-drug.png') }}" alt="Small Drugs" class="small-drug">Stemiz2</p>
							</td>
							<td><p>Stemiz2</p></td>
							<td>
								<select class="form-control">
									<option>10MG</option>
									<option>10MG</option>
									<option>10MG</option>
									<option>10MG</option>
								</select>
							</td>
							<td><p>10 Tablets</p></td>
							<td class="clsp tbl-view"><p>View +</p></td>
							<td>
								<select class="form-control">
									<option> 1Strip(s)</option>
									<option> 1Strip(s)</option>
									<option> 1Strip(s)</option>
									<option> 1Strip(s)</option>
								</select>
							</td>
							<td><p>Rs. 12.51</p></td>
							<td><a href="{{ url('cart') }}"><button class="buy-button">Buy Now</button></a></td>
						</tr> <!-- /tr -->						
					</tbody> <!-- /tbody -->

				</table> <!-- /.table -->
			</div> <!-- /.col-md-12 -->
		</div> <!-- /.row -->
	</div> <!-- /.container -->
</section> <!-- /.order-form -->


<!-- SALT DESCRIPTION -->
<section class="salt-desc-area">
	<div class="container ">
		<div class="row">
			<div class="col-md-4 col-xs-12">
				<h3 class="salt-desc-title">Salt Information</h3>
				<p>Uses</p>
				<p>Allergic rhinitis, Chronic idiopathic urticaria</p>
				<p class="salt-desc-sub">How it works</p>
				<p>It is H1 blocker has good topical activity; in addition inhibits histamine release and inflammatory reaction triggered by LTs and PAF; and has bronchodilator property.After intranasal application it has been shown to down regulate intracellular adhesion molecule-1 expression on nasal mucosa.</p>
				<p class="salt-desc-sub">Common side effects</p>
				<p>Dizziness, Headache, Drowsiness, Nausea, Anxiety, Dry mouth, Pain, Xerostomia, Ventricular fibrillation, Stevens Johnson syndrome, Cardiac dysrhythmias.</p>
				<p class="salt-desc-sub">Who should not take</p>
				<p>Cardiac insufficiency, hepatic dysfunction.</p>
			</div> <!-- /.col-md-4 -->

			<div class="col-md-4 col-xs-12">
				<h3 class="salt-desc-title">Expert Advice</h3>
				<ul class="salt-list">
					<li>It should not be taken by patients who are allergic to azatadine or any of the other ingredients of the tablet.</li>
					<li>Do not start or continue azatadine, if you have a history of asthma or high blood pressure; glaucoma or increased pressure in the eye.</li>
					<li>Do not take azatadine, if you have enlargement of the prostate, bladder issues or difficulty in urinating.</li>
					<li>Avoid using azatadine if you are breast-feeding or pregnant.</li>
					<li>Do not consume alcohol while taking azatadine.</li>
					<li>Do not drive or operate machines if you have </li>
				</ul> <!-- /.salt-list -->
			</div> <!-- /.col-md-4 -->

			<div class="col-md-4 col-xs-12">
				<h3 class="salt-desc-title">Frequently Asked Questions</h3>
				<p><b><i>Q. What is azatidine used for? </i></b></p>
				<p>Azatadine is used to treat symptoms of common cold like running nose, sneezing, itching or watery eyes and symptoms of allergy like hives, rashes, itching or other such symptoms.</p>
				<p><b><i>Q. How does azatidine work?</i></b></p>
				<p>Azatadine belongs to a class of medication call anti-histamines. Azatadine blocks the release of allergy causing chemicals in the body like histamine.</p>
				<p><b><i>Q. Is azatidine safe? Is it safe during pregnancy?</i></b></p>
				<p>Azatidine is safe when used at a dosage prescribed for your indication by the doctor. There are studies showing that azatadine may cause adverse effects in fetus or new born. Inform your doctor immediately if you find that you are pregnant while taking the drug and follow the doctor’s instructions clearly as to further use.</p>
			</div> <!-- /.col-md-4 -->

		</div> <!-- /.row -->
	</div> <!-- /.container -->
</section> <!-- /.salt-desc-area -->

@endSection