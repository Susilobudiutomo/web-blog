@extends('dashboard.layout.main')
@section('konten')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"> My Posts </h1>
  </div>
  
  @if(session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
   <strong>{{ session('success') }}</strong> 
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif

  <div class="table-responsive-sm">
    <a href="/dashboard/posts/create" class="btn btn-primary mb-3">Create Post</a>
    <table class="table table-striped table-sm border-1px">
      <thead>
        <tr class="text-center">
          <th scope="col">No</th>
          <th scope="col">Title</th>
          <th scope="col">Category</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($posts as $post)
        <tr class="text-center">
          <td>{{ $loop->iteration }}</td>
          <td>{{ $post->title }}</td>
          <td>{{ $post->category->name }}</td>
          <td>  
            <a href="/dashboard/posts/{{ $post->slug }}" class="badge bg-info">
                <span data-feather="eye" class="align-text-bottom"></span></a>
            <a href="/dashboard/posts/{{ $post->slug }}/edit" class="badge bg-warning">
                <span data-feather="edit" class="align-text-bottom"></span></a>
                <form action="/dashboard/posts/{{ $post->slug }}" method="post" class="d-inline">
                  @csrf
                  @method('delete')
                  <button class="badge bg-danger border-0" onclick="return confirm('Are You Sure?')"><span data-feather="x-circle" class="align-text-bottom"></span></a></button>
                </form>    
        </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection