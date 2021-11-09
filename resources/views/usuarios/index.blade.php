<head>
@include('layouts.head')
@include('flash-message')
<script src="{{ asset('js/app.js') }}" defer></script>

</head>
<header>
@include('layouts.header')
</header>

<body>
@include('layouts.main')
    <div>
    <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="block mb-8">
            <a href="{{ route('usuarios.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Add User</a>
        </div>
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200 w-full">
                            <thead>
                            <tr>
                                <th scope="col" width="50" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    ID
                                </th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Username
                                </th>

                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Name
                                </th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Email
                                </th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Ult acc
                                </th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Roles
                                </th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    App
                                </th>
                                <th scope="col" width="200" class="px-6 py-3 bg-gray-50">

                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($users as $user)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $user->id }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $user->username }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $user->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $user->email }}
                                    </td>

                                        @foreach ($lastentry as $idUser => $acc)
                                            @if($idUser==$user->id)
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    {{ $acc }}
                                                </td>
                                            @else
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                </td>
                                            @endif
                                        @endforeach
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        @foreach ($user->roles as $role)
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                {{ $role->name }}
                                            </span>
                                        @endforeach
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        @foreach ($user->roles as $role)
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                {{ $role->pivot->app }}
                                            </span>
                                        @endforeach
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('usuarios.show', $user->id) }}" class="text-blue-600 hover:text-blue-900 mb-2 mr-2">View</a>
                                        <a href="{{ route('usuarios.edit', $user->id) }}" class="text-indigo-600 hover:text-indigo-900 mb-2 mr-2">Edit</a>
                                        <form class="inline-block" action="{{ route('usuarios.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Está seguro que quiere eliminar definitiva a este usuario de todas las apps?');">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" class="text-red-600 hover:text-red-900 mb-2 mr-2" value="Delete">
                                        </form>
                                        <form class="inline block text-indigo-600 hover:text-indigo-900 mb-2 mr-2" method="PUT" action="{{ route('usuarios.addusers', $user->id) }}" onclick="pregunta()">
                                            <select name="roles" id="roles" class="form-multiselect block rounded-md shadow-sm mt-1 block w-full">
                                                @foreach($roles as $id => $role)
                                                    <option value="{{ $id }}"{{ in_array($id, old('roles', $user->roles->pluck('id')->toArray())) ? ' selected' : '' }}>
                                                        {{ $role }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('roles')
                                                <p class="text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                            <input type="submit" class="text-red-600 hover:text-red-900 mb-2 mr-2" value="Add/elim users">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
{!! $users->links() !!}
</body>
