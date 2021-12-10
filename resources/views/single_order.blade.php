<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Orders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg" style="padding:10px;">
                <table class="content">
                    <center>
                        <tr>
                            <td>
                                <strong>Name: </strong>{{ $user->name }}<br>
                                <strong>Shipping Address: </strong>
                                {{ $user->s_address }}, {{ $user->s_city }}, {{ $user->s_country }}<br>
                                <strong>Billing Address:</strong>
                                {{ $user->address }}, {{ $user->city }}, {{ $user->country }}<br>
                                <strong>Phone:</strong>{{ $user->mobile }}<br>
                                <strong>Email:</strong>{{ $user->email }}<br>
                            </td>
                            <td>
                                <strong>Payment Method: </strong>{{ $che->pay_method }}<br>
                                <strong>Order Status: </strong>{{ $che->order_status }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table width="600">
                                    <tr>
                                        <th align="left">Product Name </th>
                                        <th align="left">Price </th>
                                        <th align="left">Qty. </th>
                                        <th align="left">Total</th>
                                    </tr>

                                    @foreach ($ord as $value)

                                    <tr>
                                        <td>{{ $value->p_name }}</td>
                                        <td>{{ $value->p_price }}</td>
                                        <td>{{ $value->qty }}</td>
                                        <td>{{ $value->price_total }}</td>
                                    </tr>

                                    @endforeach

                                    <tr>
                                        <td></td>
                                        <td colspan="2">Sub Total: </td>
                                        <td>
                                            @php $sub_total = 0; @endphp
                                            @foreach($ord as $c)
                                            @php $sub_total += $c->price_total; @endphp
                                            @endforeach
                                            {{ $sub_total }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td colspan="2">Shipping Cost: </td>
                                        <td>{{ $che->shipping_cost }}</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td colspan="2">Total: </td>
                                        <td>{{ $che->final_total }}</td>
                                    </tr>
                                </table>
                            </td>
                            <td>

                                @if ($che->order_status == 'pending')

                                <center><b style="color:red">Order Cancelation</b>
                                    <form action="{{ route('orderCancel') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $che->id }}">
                                        <!-- <input type="hidden" name="qty" value="{{ $value->qty }}">
                                        <input type="hidden" name="pid" value="{{ $value->pid }}"> -->
                                        <input type="hidden" name="order_status" value="cancel">
                                        <x-jet-danger-button type="submit">
                                            {{ __('Cancel') }}
                                        </x-jet-danger-button>
                                    </form>
                                </center>


                                @elseif (($che->order_status == 'confirm'))
                                <center><b style="color:green">Order Confirmed</b>

                                    @elseif (($che->order_status == 'processing'))
                                    <center><b style="color:green">Your order will arrive soon</b>

                                        @elseif (($che->order_status == 'complete'))
                                        <center><b style="color:green">Order completed.<br>Thanks for parchaging</b>

                                            @else
                                            <center><b style="color:red">Your Order is canceled</b>
                                                @endif
                            </td>
                        </tr>
                    </center>
            </div>
        </div>
    </div>
</x-app-layout>