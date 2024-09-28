@php $payment = 0; @endphp

@foreach ($cartProducts as $cartProduct)
    @php $payment += $cartProduct['product']['price'] * $cartProduct['quantity']; @endphp
@endforeach

{{ $payment }}
