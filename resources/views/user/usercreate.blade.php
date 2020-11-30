<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Create') }}
        </h2>
    </x-slot>




    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <x-guest-layout>
                        <x-auth-card>
                            <x-slot name="logo">
                                <a href="/">
                                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                                </a>
                            </x-slot>

                            <form action="{{url('/usercreatedone')}}" method="Post">
                                @csrf
                                <div class="form-group">
                                    <label for="rolename">Name</label>
                                    <input type="input" class="form-control" name="username">

                                    <label for="rolename">Email</label>
                                    <input type="input" class="form-control" name="email">

                                    <label for="rolename">Password</label>
                                    <input type="password" class="form-control" name="password">
                                </div>

                                <div>
                                    @foreach($all_roles as $role)
                                    <input type="checkbox" class="form-control" id="Writer" value="{{$role->name}}" name="role[]"> {{$role->name}}
                                    @endforeach
                                </div>

                                <br />

                                <button type="submit" class="btn btn-primary btn-sm">User Register</button>
                            </form>

                        </x-auth-card>
                    </x-guest-layout>


                </div>
            </div>
        </div>


    </div>

</x-app-layout>