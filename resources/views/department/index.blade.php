@extends('layouts.main')
@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Departments</h1>
</div>
<div class="row">
   <div class="card mx-auto">
    @if (session()->has('message'))
    <div class="alert alert-success mb-2" role="alert">
      {{session('message')}}
    </div>
    @endif
       <div class="card-header">
          <form class="row gy-2 gx-3 align-items-center" method="Get" action="{{route('departments.index')}}">
            <div class="col-auto">
              <input type="search" name="search" class="form-control" placeholder="Search">
            </div>
            <div class="col-auto">
              <button type="submit" class="btn btn-primary">Search</button>
            </div>
            <div class="col-auto">
              <a href="{{route('departments.create')}}" class="btn btn-primary float-right">Create</a>
            </div>
          </form>
       </div>
       <div class="card-body">
           <table class="table table-striped">
               <thead>
                 <tr>
                   <th scope="col">#Id </th>
                   <th scope="col">Name</th>
                   <th scope="col">Manage</th>
                 </tr>
               </thead>
               <tbody>
                 @foreach ($departments as $department)    
                 <tr>
                   <th scope="row">{{$department->id}}</th>
                   <td>{{$department->name}}</td>
                   <td>
                    <a href="{{route('departments.edit',$department->id)}}" class="btn btn-success">Edit</a>
                    
                  </td>
                 </tr>
                 @endforeach
               </tbody>
             </table>
       </div>
   </div>
</div>
@endsection