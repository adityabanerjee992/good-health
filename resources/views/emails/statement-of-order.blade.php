<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
body {
	margin: 0;
	padding: 0;
	background-color: #fff;
}
 @page {
 size: A4;
 margin: 0;
}
@media print {
.page {
	margin: 0;
	border: initial;
	border-radius: initial;
	width: initial;
	min-height: initial;
	box-shadow: initial;
	background: initial;
	page-break-after: always;
}
}
</style>

</head>

<body>
<table width="800" border="0" align="center" cellpadding="0" cellspacing="0" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; line-height:20px;">

  <tr>
   <td style="padding-bottom: 10px; padding-top: 15px; color: #444; border-bottom: 2px solid #00A793; font-size: 25px; text-transform: uppercase; margin-bottom: 0px; text-align:center;">Statement of Order</td>
  </tr>
  
  
  <tr>
   <td>
   		<table border="0" width="100%" cellpadding="0" cellspacing="0" style="border:1px solid #cfcfcf; padding: 15px 20px;">
        	<tr>
            	<td style="width:20%"><span style="margin: 0px; padding: 0px; font-size: 14px; color: #444; display: block;">Shipping Address</span>
                    <span style="margin: 0px; padding: 8px 0px 2px; font-size: 14px; color: #444; display: block; font-weight: 600;">{{ $userAddress->name }}</span>
  	       				<span style="margin: 0px; padding: 0px; font-size: 12px; color: #444; line-height: 16px">               
                    
                    <p> {{ $userAddress->address}} ,
                        {{ $userAddress->pincode }}
                        <br>{{ $userAddress->country }}
                        <br>T: {{ $userAddress->phone }}
                    </p>
                  
                  </span>
              </td>
              <td style="width:20%"><span style="margin: 0px; padding: 0px; font-size: 14px; color: #444; display: block;">Billing Address</span>
                    <span style="margin: 0px; padding: 8px 0px 2px; font-size: 14px; color: #444; display: block; font-weight: 600;">{{ $userAddress->name }}</span>
                  <span style="margin: 0px; padding: 0px; font-size: 12px; color: #444; line-height: 16px">               
                    
                    <p> {{ $userAddress->address}} ,
                        {{ $userAddress->pincode }}
                        <br>{{ $userAddress->country }}
                        <br>T: {{ $userAddress->phone }}
                    </p>
                  
                  </span>
              </td>
                <td style="width:50%"><span style="margin: 0px; padding: 0px; font-size: 14px; color: #444; display: block; font-weight: 600;">Shipping Method</span>
                    <span style="margin: 0px; adding: 0px; font-size: 14px; color: #444; display: block; ">Free shipping only above 500 INR</span>
					<span style="margin: 0px; padding: 10px 0 0; font-size: 14px; color: #444; display: block; font-weight: 600;">Payment Method</span>
                    <span style="margin: 0px; adding: 0px; font-size: 14px; color: #444; display: block; ">{{ $paymentTypeDetails->name }}</span>
                </td>
            </tr> 
        </table>
   </td>
  </tr>
  <tr>
  	<td style="padding-bottom: 12px; padding-top: 10px;"><span style="font-size: 14px; color: #444; margin: 0px; font-weight:bold;">Items Ordered</span></td>
  </tr>

  
  <tr>
   <td>
     <?php $total = 0; ?>

   		<table border="0" width="100%" cellpadding="0" cellspacing="0" style="border:1px solid #cfcfcf; padding: 15px 20px;">
        	<tr>
            	<td style="width:30%; border-bottom:1px solid #cfcfcf; color: #444; font-weight:bold; font-size: 14px; border-bottom: 1px solid #DDD; text-transform: none; padding: 15px 8px;">Product Name</td>
                <td style="width:20%; border-bottom:1px solid #cfcfcf; color: #444; font-weight:bold; font-size: 14px; border-bottom: 1px solid #DDD; text-transform: none; padding: 15px 8px;">Company Name</td>
                <td style="width:13%; border-bottom:1px solid #cfcfcf; color: #444; font-weight:bold; font-size: 14px; border-bottom: 1px solid #DDD; text-transform: none; padding: 15px 8px;">SKU</td>
                <td style="width:12%; border-bottom:1px solid #cfcfcf; color: #444; font-weight:bold; font-size: 14px; border-bottom: 1px solid #DDD; text-transform: none; padding: 15px 8px;">Price</td>
                <td style="width:15%; border-bottom:1px solid #cfcfcf; color: #444; font-weight:bold; font-size: 14px; border-bottom: 1px solid #DDD; text-transform: none; padding: 15px 8px;">Qty</td>
                <td style="width:10%; border-bottom:1px solid #cfcfcf; color: #444; font-weight:bold; font-size: 14px; border-bottom: 1px solid #DDD; text-transform: none; padding: 15px 8px; text-align:right;">Subtotal</td>
            </tr> 
            
              @foreach($orderDetails as $orderDetail)

                  <tr>
                    <td style="border-bottom:1px solid #cfcfcf; padding: 15px 8px; font-size: 12px; vertical-align: middle;">{{ $orderDetail->product_name }}</td>
                    <td style="border-bottom:1px solid #cfcfcf; padding: 15px 8px; font-size: 12px; vertical-align: middle;">{{ $companies[$orderDetail->product_id] }}</td>
                    <td style="border-bottom:1px solid #cfcfcf; padding: 15px 8px; font-size: 12px; vertical-align: middle;">{{ $orderDetail->product_code }}</td>
                    <td style="border-bottom:1px solid #cfcfcf; padding: 15px 8px; font-size: 12px; vertical-align: middle;">Rs. {{ $orderDetail->price }}</td>
                    <td style="border-bottom:1px solid #cfcfcf; padding: 15px 8px; font-size: 12px; vertical-align: middle;"> {{ $orderDetail->quantity }} {{ \App\Product::find($orderDetail->product_id)->categories->first()->category_name }}(s)<span style="color: #888; display: block;">({{ \App\Product::find($orderDetail->product_id)->packings->first()->packing_type .' '. \App\Product::find($orderDetail->product_id)->categories->first()->category_name .' in a '. \App\Product::find($orderDetail->product_id)->units->first()->unit_type }})</span></td>

                    <td style="border-bottom:1px solid #cfcfcf; padding: 15px 8px; font-size: 12px; vertical-align: middle; text-align:right;">Rs. {{ $orderDetail->price * $orderDetail->quantity }}</td>

                    </tr> <!-- /tr -->

                    <?php $total =  ($orderDetail->price * $orderDetail->quantity) + $total; ?>
              @endForeach
            
            <tr>
            	<td colspan="5" style="font-size: 12px; color: #444; text-align:right; padding: 5px 0px;">Subtotal</td>
                <td style="font-size: 12px; color: #444; text-align:right; padding: 5px 0px;">{{ $total }}</td>
            </tr> 
            <tr>
            	<td colspan="5" style="font-size: 12px; color: #444; text-align:right; padding: 5px 0px;">Shipping & Handling</td>
                <td style="font-size: 12px; color: #444; text-align:right; padding: 5px 0px;">Rs.0.00</td>
            </tr> 
            <tr>
            	<td colspan="5" style="font-size: 12px; color: #444; text-align:right; padding: 5px 0px;">Discount (15% On the total medicine bill)</td>
                <td style="font-size: 12px; color: #444; text-align:right; padding: 5px 0px;">-Rs.{{ ($total/100) * 15 }}</td>
            </tr> 
            <tr>
            	<td colspan="5" style="font-size: 12px; color: #444; text-align:right; padding: 5px 0px;">Total After Discount</td>
                <td style="font-size: 12px; color: #444; text-align:right; padding: 5px 0px;">Rs.{{ ($total/100) * 85 }}</td>
            </tr> 
            <tr>
            	<td colspan="5" style="font-size: 12px; color: #444; text-align:right; padding: 5px 0px;">Tax (12% On Rs {{ ($total/100) * 85 }})</td>
                <td style="font-size: 12px; color: #444; text-align:right; padding: 5px 0px;">Rs. {{ (((($total/100) * 85)/100)* 12)}}</td>
            </tr>
            <tr>
            	<td colspan="5" style="font-size: 12px; color: #444; text-align:right; color: #01A894; padding: 5px 0px; font-weight:bold;">Grand Total </td>
              <?php  $grandTotal = round(($total- ($total/100) * 15)  + (((($total/100) * 85)/100)* 12),2);  ?>
                <td style="font-size: 12px; color: #444; text-align:right; color: #01A894; padding: 5px 0px; font-weight:bold;">Rs. {{ $grandTotal }}</td>
            </tr> 
        </table>
   </td>
  </tr>
  <tr>
  	<td style="padding: 10px 0px;"><span style="font-size:12px; color:#333; font-weight:bold; padding-right:3px;">Disclaimer : </span> <span style="font-size:12px; color:#333;">Your order will be reviewed by a Chemist before it will be processed. And it can take approximately 24-48 hours.</span></td>
  </tr>
  
</table>
</body>
</html>