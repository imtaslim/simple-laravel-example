<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <table class="content">
                    <center>
                        <h2 align="center">All Products</h2>
                        <tr>
                            <th>Profile Picture</th>
                            <th>User's Name</th>
                            <th>User's Email</th>
                            <th>User's Phone</th>
                            <th>User's Address</th>
                            <th>User's City</th>
                            <th>User's Country</th>
                            <th>Status</th>
                            <th>Delete</th>
                        </tr>
                        @foreach ($user as $val)

                        <tr>
                            <td align="center">
                                <div class="mt-2" x-show="! photoPreview">
                                    <img src="{{ $val->profile_photo_url }}" alt="{{ $val->name }}"
                                        class="h-20 w-20 object-cover">
                                </div>
                            </td>
                            <td>{{ $val->name }}</td>
                            <td>{{ $val->email }}</td>
                            <td>{{ $val->mobile }}</td>
                            <td>{{ $val->address }}</td>
                            <td>{{ $val->city }}</td>
                            <td>{{ $val->country }}</td>
                            <td align="center">
                                <b style="color:blue">{{ $val->user_type }}</b><br>
                                <table align="center">
                                    <form action="process/update_user_status_process.php" method="post">
                                        <tr>
                                            <td align="center"><input type="hidden" name="u_id" value="{{ $val->u_id'">
                                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center"><input type="submit" value="Change"></td>
                                        </tr>
                                    </form>
                                </table>
                            </td>
                            <td><a href="">DEL</a></td>
                        </tr>
                        @endforeach
                    </center>
                </table>
            </div>
        </div>
    </div>
</x-admin-layout>