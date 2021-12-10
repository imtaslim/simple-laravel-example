<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categories') }}
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
                    <form action="{{ route('addCatProcess') }}" method="post">
                    <h2 align="center">Add Category</h2>
                        @csrf
                        <table>
                            <tr>
                                <td>Category Name: </td>
                                <td><input type="text" name="cat_name" placeholder="Enter Category Name"></td>
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
                <h2 style='color:green'>All Categories</h2>
                    <thead>
                        <tr>
                            <th>Category Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cat as $val)
                        <tr>
                            <td>{{ $val->cat_name }}</td>
                            <td>
                                
                                <form method="POST" action="{{ route('delCat', [ 'id'=> $val->id ]) }}">
                                    @csrf
                                    <button><a href="{{ route('editCat', [ 'id'=> $val->id ]) }}">Edit</a> | 
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
