<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Manager') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($all_users as $user)
                        <tr>
                            <th scope="row">{{$user->id}}</th>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                                <a href="/user/edit/{{$user->id}}" class="btn btn-primary btn-sm">Edit</a>
                                <a href="/user/delete/{{$user->id}}" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <h1></h1>
                <form action="{{url('/roleassign')}}" method="post">
                    @csrf
                    <td>
                        <input type="input" class="form-control" placeholder="Type an email address" id="email" name="email">
                        @foreach($all_roles as $role)
                        <input type="checkbox" class="form-control" id="Writer" value="{{$role->name}}" name="role[]"> {{$role->name}}
                        @endforeach
                        <button class="btn btn-primary btn-sm">Assign</button>
                    </td>
                </form>

            </div>
        </div>
    </div>

    </div>

</x-app-layout>