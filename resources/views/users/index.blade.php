@extends('layouts.main')
@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Users</h1>
</div>
<div class="row">
   <div class="card mx-auto">
    @if (session()->has('message'))
    <div class="alert alert-success mb-2" role="alert">
      {{session('message')}}
    </div>
    @endif
       <div class="card-header">
          <form class="row gy-2 gx-3 align-items-center" method="Get" action="{{route('users.index')}}">
            <div class="col-auto">
              <input type="search" name="search" class="form-control" placeholder="Search">
            </div>
            <div class="col-auto">
              <button type="submit" class="btn btn-primary">Search</button>
            </div>
            <div class="col-auto">
              <a href="{{route('users.create')}}" class="btn btn-primary float-right">Create</a>
            </div>
          </form>
       </div>
       <div class="card-body">
           <table class="table table-striped">
               <thead>
                 <tr>
                   <th scope="col">#Id </th>
                   <th scope="col">Username</th>
                   <th scope="col">Email</th>
                   <th scope="col">Manage</th>
                 </tr>
               </thead>
               <tbody>
                 @foreach ($users as $user)    
                 <tr>
                   <th scope="row">{{$user->id}}</th>
                   <td>{{$user->username}}</td>
                   <td>{{$user->email}}</td>
                   <td>
                    <a href="{{route('users.edit',$user->id)}}" class="btn btn-success">Edit</a>
                    
                  </td>
                 </tr>
                 @endforeach
               </tbody>
             </table>
       </div>
   </div>
</div>
@endsection