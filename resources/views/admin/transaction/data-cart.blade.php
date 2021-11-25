@forelse ($carts as $cart)
    <tr>
        <td>{{ $cart->food->name }}</td>
        <td>{{ $cart->food->price }}</td>
        <td>{{ $cart->qty }}</td>
        <td id="total">{{ $cart->price }}</td>
        <td>
            <Button class="btn btn-danger btn-sm" id="delete_cart" data-cart_id="{{ $cart->id }}">Delete</Button>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="5" align="center">Tidak Ada Data</td>
    </tr>
@endforelse
