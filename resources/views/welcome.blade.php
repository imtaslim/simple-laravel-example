<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('HOME') }}
        </h2>
    </x-slot>
    <nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
        <!-- Primary Navigation Menu -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <x-jet-dropdown align="right" width="40">
                        <x-slot name="trigger">
                            <button
                                class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                                {{ __('Categories') }}
                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Categories List') }}
                            </div>
                            @foreach ($cat as $val)
                            <x-jet-dropdown-link href="{{ route('home', [ 'id'=> $val->id ]) }}">
                                {{ __($val->cat_name) }}
                            </x-jet-dropdown-link>
                            @endforeach
                        </x-slot>
                    </x-jet-dropdown>
                </div>
            </div>
        </div>
    </nav>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg" style="padding:10px;">

                <b style="color:red">
                    <?php
                    if (isset($_GET['msg'])) {
                        echo $_GET['msg'];
                    }
                    ?>
                </b>

                <ul>
                    @if (!isset($_GET['id']))
                    @foreach ($pro as $val)
                    <li class='prd'>
                        <img src="{{ asset('image/'. $val->image_path) }}" height="50" width="80"><br>
                        {{ $val->p_name }}<br>
                        <strong>Price: </strong>{{ $val->p_price }}<br>

                        @if ($val->p_stock < 1) <b style="color:red">Out of Stock</b>
                            @else


                            <strong>Stock: </strong>{{ $val->p_stock }}<br>
                            <form action="{{ route('cartpro') }}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{ $val->id }}">
                                <input type="hidden" name="qty" value="1" min="1"><br>
                                <x-jet-button wire:loading.attr="disabled" wire:target="photo" type="submit">
                                    {{ __('Add to Cart') }}
                                </x-jet-button>
                            </form>
                            <x-jet-button wire:loading.attr="disabled">
                                <a href="{{ route('sinpro', [ 'id'=> $val->id ]) }}">View</a>
                            </x-jet-button>
                            @endif
                    </li>
                    @endforeach
                    @else

                    @foreach ($join as $value)

                    <li class='prd'>
                        <img src="{{ asset('image/'. $value->image_path) }}" height="50" width="80"><br>
                        {{ $value->p_name }}<br>
                        <strong>Price: </strong>{{ $value->p_price }}<br>

                        @if ($value->p_stock < 1) <b style="color:red">Out of Stock</b>
                            @else


                            <strong>Stock: </strong>{{ $value->p_stock }}<br>
                            <form action="{{ route('cartpro') }}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{ $value->id }}">
                                <input type="hidden" name="qty" value="1" min="1"><br>
                                <x-jet-button wire:loading.attr="disabled" wire:target="photo" type="submit">
                                    {{ __('Add to Cart') }}
                                </x-jet-button>
                            </form>
                            <x-jet-button wire:loading.attr="disabled">
                                <a href="{{ route('sin_or', [ 'id'=> $val->id ]) }}">View</a>
                            </x-jet-button>
                            @endif
                    </li>
                    @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>