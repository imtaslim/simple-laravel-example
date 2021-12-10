<x-admin-layout>
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

                                @if ($che->order_status == 'cancel')
                                <center><b style="color:red">This order is canceled</b></center>
                                @else
                                <center>
                                    <form action="{{ route('or_Cancel') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $che->id }}">
                                        <p>Change Status:
                                            <select name="order_status">
                                                <option value="pending">pending</option>
                                                <option value="confirm">Confirm</option>
                                                <option value="processing">Processing</option>
                                                <option value="complete">Complete</option>
                                                <option value="cancel">Cancel</option>
                                            </select>
                                        </p><br>
                                        <x-jet-button type="submit">
                                            {{ __('Change') }}
                                        </x-jet-button>
                                    </form>
                                </center>
                                @endif
                            </td>
                        </tr>
                    </center>
            </div>
        </div>
    </div>
</x-admin-layout>