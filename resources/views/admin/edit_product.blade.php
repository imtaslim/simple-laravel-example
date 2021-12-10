<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
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
                    <h2 align="center">Edit Products</h2>
                    @foreach ($prod as $pro)
                        <form action="{{ route('uppro', [ 'id'=> $pro->id ]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                            <table>
                                <tr>
                                    <td>Product name:</td>
                                    <td><input type="text" name="p_name" value="{{ $pro->p_name }}"></td>
                                </tr>
                                <tr>
                                    <td>Product Category:</td>
                                    <td>
                                        <select name="cid">
                                            <option value="{{ $pro->cid }}">{{ $pro->cat_name }}</option>
                                                @foreach ($cat as $v) 
                                                    <option value="{{ $v->cid }}">{{ $v->cat_name }}</option>
                                                @endforeach
                                            
                                        </select>				
                                    </td>
                                </tr>
                                <tr>
                                    <td>Product Price:</td>
                                    <td><input type="text" name="p_price" value="{{ $pro->p_price }}"></td>
                                </tr>
                                <tr>
                                    <td>Product Description:</td>
                                    <td><textarea cols="35" rows="5" name="p_desc">{{ $pro->p_desc }}</textarea></td>
                                </tr>
                                <tr>
                                    <td>Product Brand:</td>
                                    <td><input type="text" name="p_brand" value="{{ $pro->p_brand }}"></td>
                                </tr>
                                <tr>
                                    <td>Product Stock:</td>
                                    <td><input type="number" name="p_stock" value="{{ $pro->p_stock }}"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><img src="{{ asset('image/'. $pro->image_path) }}" width="60"></td>
                                </tr>
                                <tr>
                                    <td>Product Image:</td>
                                    <td><input type="file" name="image"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><input type="submit" value="Submit"></td>
                                </tr>
                            </table>
                        </form>
                    @endforeach
                    </center>
            </div>
        </div>
    </div>
</x-admin-layout>
