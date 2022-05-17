<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            USERS
        </h2>
    </x-slot>

    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Liste des utilisateurs') }}</div>

                <div class="card-body">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>

                        <th scope="col">Rôles</th>
                        <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap" >{{ $user->id }}</th>
                            <td>{{ $user->name }} </td>
                            
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{implode(', ', $user->roles()->get()->pluck('name')->toArray()) }}</td>
                            <td>
                                
                                <a href="{{ route('admin.users.edit', $user->id) }}"><x-button class="btn btn-blue">Editer</x-button></a>
                                
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <x-button class="btn btn-red">Supprimer</x-button>
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
</x-app-layout>
