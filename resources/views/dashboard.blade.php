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
                            <th>Order Id</th>
                            <th>Payment Method</th>
                            <th>Total Bill</th>
                            <th>Order Status</th>
                            <th>Order Time</th>
                            <th>Manage</th>
                        </tr>


                        @foreach ($che as $val)

                        <tr>
                            <td>{{ $val->id }}</td>
                            <td>{{ $val->pay_method }}</td>
                            <td>{{ $val->final_total }}</td>
                            <td>{{ $val->order_status }}</td>
                            <td>{{ $val->created_at }}</td>
                            <td>
                                <x-jet-button wire:loading.attr="disabled">
                                    <a href="{{ route('sin_or', [ 'id'=> $val->id ]) }}">View</a>
                                </x-jet-button>
                            </td>
                        </tr>

                        @endforeach

                    </center>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>