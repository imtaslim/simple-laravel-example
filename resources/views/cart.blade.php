<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cart') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg" style="padding:10px;">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @if (count($cart) < 1) <p style="font-size:30px;" align="center">Cart is empty!</p>

                    @else
                    <strong>Name: </strong>{{ $user->name }}<br>
                    <strong>Shipping Address:
                    </strong>{{ $user->s_address }}, {{ $user->s_city }}, {{ $user->s_country }}<br>
                    <strong>Billing Address:
                    </strong>{{ $user->address }}, {{ $user->city }}, {{ $user->country }}<br>
                    <strong>Email: </strong>{{ $user->email }}<br>
                    <strong>Mobile: </strong>{{ $user->mobile }}<br>
                    <strong>Change Shipping </strong>
                    <x-jet-button class="ml-4">
                        <a href="{{ route('address') }}">Address</a>
                    </x-jet-button>
                    <P>&nbsp;</P>
                    <table width="600">

                        <tr>
                            <th align="left">Product Name </th>
                            <th align="left">Price </th>
                            <th align="left">Qty. </th>
                            <th align="left">Total</th>
                            <th align="left">Action</th>
                        </tr>
                        @foreach ($cart as $val)
                        <tr>
                            <td>{{ $val->p_name }}</td>
                            <td>{{ $val->p_price }}</td>
                            <td>{{ $val->qty }}</td>
                            <td>{{ $val->price_total }}</td>
                            <td>
                                <form method="POST" action="{{ route('cancelcart', [ 'id'=> $val->id ]) }}">
                                    @csrf
                                    <input type="hidden" name="_method" value="DELETE">
                                    <x-jet-button class="ml-4" type="submit">
                                        {{ __('Cancel') }}
                                    </x-jet-button>
                                </form>

                            </td>
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="5">
                                <hr>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="2">Sub Total:</td>
                            <td>
                                @php $sub_total = 0; @endphp
                                @foreach($cart as $c)
                                @php $sub_total += $c->price_total; @endphp
                                @endforeach
                                {{ $sub_total }}
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="2">Shipping Charge:</td>
                            <td>
                                @php $charge = 0; @endphp
                                @if ($user->s_city != "Khulna")
                                @php $charge = 100; @endphp
                                @else
                                @php $charge = 50; @endphp
                                @endif
                                {{ $charge }}

                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="5">
                                <hr>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="2">Total:</td>
                            <td>{{ $sub_total + $charge }}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="5">
                                <hr>
                                <form action="{{ route('checkoutprocess') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="shipping_cost" value="{{ $charge }}">
                                    <input type="hidden" name="final_total" value="{{ $sub_total + $charge }}">
                                    @if ($user->s_city != "Khulna")
                                    <strong>Courier: </strong><br>
                                    <input type="radio" name="courier" value="Sundarban Courier Service"
                                        checked>Sundarban Courier Service<br>
                                    <input type="radio" name="courier" value="SA Paribahan">SA Paribahan
                                    <hr>
                                    @endif

                                    <strong>Payment Method: </strong><br>
                                    @foreach ($pay as $value)
                                    @if ($value->pay_name === "Cash On Delivery")
                                    <input type="radio" name="pay_name" value="{{ $value->pay_name }}"
                                        checked>{{ $value->pay_name }}<br>
                                    @else
                                    <input type="radio" name="pay_name"
                                        value="{{ $value->pay_name }}">{{ $value->pay_name }}<br>
                                    @endif
                                    @endforeach

                                    <p>&nbsp;</p>
                                    <x-jet-button wire:loading.attr="disabled" wire:target="photo" type="submit">
                                        {{ __('Checkout') }}
                                    </x-jet-button>
                                    <x-jet-button wire:loading.attr="disabled">
                                        <a href="{{ route('clearcart') }}">Clear Cart</a>
                                    </x-jet-button>
                                </form>
                            </td>
                            @endif
            </div>
        </div>
    </div>
</x-app-layout>