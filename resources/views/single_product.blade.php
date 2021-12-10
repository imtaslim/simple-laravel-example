<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Single Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg" style="padding:10px;">

                <table class='content'>
                    <tr>
                        <td align="center"><img src="{{ asset('image/'. $pro->image_path) }}" height="300" width="300">
                        </td>
                    </tr>
                    <tr>
                        <td align="center">
                            <h2>{{ $pro->p_name }}</h2>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table class='content'>
                                <tr>
                                    <td>Product Description: </td>
                                    <td>{{ $pro->p_desc }}</td>
                                </tr>
                                <tr>
                                    <td>Price: </td>
                                    <td>{{ $pro->p_price }}</td>
                                </tr>
                                <tr>
                                    <td>Brand: </td>
                                    <td>{{ $pro->p_brand }}</td>
                                </tr>
                                <tr>
                                    <td>In Stock: </td>
                                    <td>{{ $pro->p_stock }}</td>
                                </tr>
                            </table>
                        </td>
                    <tr>
                    <tr>
                        <td align="center">
                            <form action="{{ route('cartpro') }}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{ $pro->id }}">
                                <input type="number" name="qty" value="1" min="1"><br>
                                <x-jet-button wire:loading.attr="disabled" wire:target="photo" type="submit">
                                    {{ __('Add to Cart') }}
                                </x-jet-button>
                            </form>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>