<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Payment Method') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <center>
                    <form action="{{ route('addpayProcess') }}" method="post">
                    <h2 align="center">Payment Method</h2>
                    @csrf
                        <table>
                                <tr>
                                    <td>Method Name:</td>
                                    <td><input type="text" name="pay_name"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><input type="submit" value="Submit"></td>
                                </tr>
                        </table>	
                    </form>
                </center>
                <hr>
                <center>
                <table class='content'>
                <h2 style='color:green'>All Pay Methods</h2>
                    <thead>
                        <tr>
                            <th>Pay Method Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pay as $val)
                        <tr>
                            <td>{{ $val->pay_name }}</td>
                            <td>
                                <form method="POST" action="{{ route('delpay', [ 'id'=> $val->id ]) }}">
                                    @csrf
                                    <button><a href="{{ route('editpay', [ 'id'=> $val->id ]) }}">Edit</a> | 
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="submit" value="Delete">
                                </form></button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </center>
            </div>
        </div>
    </div>
</x-admin-layout>
