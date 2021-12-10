<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sipping Address') }}
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
                <center>
                    <form action="{{ route('updateaddress', [ 'id'=> $user->id ]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <table>
                            <tr>
                                <td colspan="2" align="center">
                                    <strong>User Name: </strong>{{ $user->name }}
                                </td>
                            </tr>
                            <tr>
                                <td>Shipping Address: </td>
                                <td><input type="text" name="s_address" value="{{ $user->s_address }}"></td>
                            </tr>
                            <tr>
                                <td>Shipping City: </td>
                                <td><input type="text" name="s_city" value="{{ $user->s_city }}"></td>
                            </tr>
                            <tr>
                                <td>Shipping Country: </td>
                                <td><input type="text" name="s_country" value="{{ $user->s_country }}"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <x-jet-button wire:loading.attr="disabled" wire:target="photo" type="submit">
                                        {{ __('Update') }}
                                    </x-jet-button>
                                </td>
                            </tr>
                        </table>
                    </form>
                </center>
            </div>
        </div>
    </div>
</x-app-layout>