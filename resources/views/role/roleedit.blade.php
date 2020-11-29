<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Role Manager') }}
        </h2>
    </x-slot>




    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <form action="{{url('/role/update/'.$role->id)}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="rolename">Role Name</label>
                            <input type="input" class="form-control" id="exampleInputEmail1" name="rolename" value="{{$role->name}}" aria-describedby="emailHelp">
                            <small id="rolenameHelp" class="form-text text-muted">Please, type a unique name for the role.</small>
                        </div>

                        <button type="submit" class="btn btn-primary btn-sm">Edit Role</button>
                    </form>

                </div>
            </div>
        </div>


    </div>

</x-app-layout>