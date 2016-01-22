 {!! Form::open(array('route' => array('cart-cancel-order'), 'method' => 'post')) !!}
    <input type="hidden" name="order_id" value="{{ $order->id }}" />
    {!! Form::token() !!}
    <li><a href="#" class="email-presc"> <button type="submit"> Cancel Order </button></a></li>
 {!! Form::close() !!}