<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Payment Method') }}
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
                    <form action="{{ route('uppay', [ 'id'=> $pay->id ]) }}" method="post">
                    <h2 align="center">Payment Method</h2>
                    @csrf
                    @method('PUT')
                        <table>
                                <tr>
                                    <td>Method Name:</td>
                                    <td><input type="text" name="pay_name" value="{{ $pay->pay_name }}"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><input type="submit" value="Submit"></td>
                                </tr>
                        </table>	
                    </form>
                </center>
            </div>
        </div>
    </div>
</x-admin-layout>
