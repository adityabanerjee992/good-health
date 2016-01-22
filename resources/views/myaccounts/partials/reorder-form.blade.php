 {!! Form::open(array('route' => array('cart-reorder'), 'method' => 'post')) !!}
    <input type="hidden" name="order_id" value="{{ $order->id }}" />
    {!! Form::token() !!}
    <li><a href="#" class="email-presc"> <button type="submit"> Reorder </button></a></li>
 {!! Form::close() !!}