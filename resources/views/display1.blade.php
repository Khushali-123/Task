<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <h1><b>All Users</b></h1>
                <br>

                <table class="table">
                  
                 <thead class="thead-dark">
             
                     <tr>
                        <th >Id</th>
                        <th >Name</th>
                        <th >Date of birth</th>

                        <th >gender</th>
                        <th >Email</th>
                        <th >Phone Number</th>
                        <th >Type</th> 
                     </tr>
                  </thead>
              
                   <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->fname ." ".$user->lname }}</td>
                            
                            <td>{{$user->dob}}</td>
                            <td>{{$user->gender}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->number}}</td>
                            <td>{{$user->type}}</td>
                        </tr>
                        @endforeach
                    </tbody>
               </table>
               {{ $users->links() }}

            </div>
        </div>
    </div>
</x-app-layout>
