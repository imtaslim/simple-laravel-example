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
                    <h2 align="center">Add Products</h2>
                    <form action="{{ route('addproProcess') }}" method="post" enctype="multipart/form-data">
                    @csrf
                        <table>
                            <tr>
                                <td>Product name:</td>
                                <td><input type="text" name="p_name"></td>
                            </tr>
                            <tr>
                                <td>Product Category:</td>
                                <td>
                                    <select name="cid">
                                        <option value="">Select a category</option>
                                        @foreach ($cat as $v)
                                            <option value="{{ $v->id }}">{{ $v->cat_name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Product Price:</td>
                                <td><input type="text" name="p_price"></td>
                            </tr>
                            <tr>
                                <td>Product Description:</td>
                                <td><textarea cols="35" rows="5" name="p_desc"></textarea></td>
                            </tr>
                            <tr>
                                <td>Product Brand:</td>
                                <td><input type="text" name="p_brand"></td>
                            </tr>
                            <tr>
                                <td>Product Stock:</td>
                                <td><input type="number" name="p_stock"></td>
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
                    </center>
                <hr>
                <center>
                    <table class='content'>
                    <h2 style='color:green'>All Products</h2>
                        <thead>
                            <tr>
                                <th>Product name</th>
                                <th>Product category</th>
                                <th>Product price</th>
                                <th>Product stock</th>
                                <th>Product brand</th>
                                <th>Product image</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pro as $val)
                            <tr>
                                <td>{{ $val->p_name }}</td>
                                <td>{{ $val->cat_name }}</td>
                                <td>{{ $val->p_price }}</td>
                                <td>{{ $val->p_stock }}</td>
                                <td>{{ $val->p_brand }}</td>
                                <td>
                                    <img src="{{ asset('image/'. $val->image_path) }}" width="100">
                                </td>
                                <td>
                                    <form method="POST" action="{{ route('delpro', [ 'id'=> $val->id ]) }}">
                                        @csrf
                                        <button><a href="{{ route('editpro', [ 'id'=> $val->id ]) }}">Edit</a> | 
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
