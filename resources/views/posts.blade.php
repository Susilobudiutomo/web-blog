@extends('layout.main')
@section('konten')
<div class="container-fluid">
    <div class="row mt-3 text-center">
        <div class="col">
            <h1 class="mb-3">{{ $title }}</h1>
<div class="row justify-content-center">
  <div class="col-md-6">
    <form action="/posts">
      @if(request('category'))
<input name="category" type="hidden" value="{{ request('category') }}">
      @endif
      @if(request('author'))
      <input name="author" type="hidden" value="{{ request('author') }}">
            @endif
    <div class="input-group mb-3">
      <input type="text" class="form-control" placeholder="Search..." name="search" value="{{ request('search') }}">
      <button class="btn btn-primary" type="submit">Search</button>
    </div>
    </form>
  </div>
</div>
@if ($posts->count())

            <div class="card mb-3">
               @if ($posts[0]->image) 
              <div style="max-height: 350px; overflow:hidden;" >
              <img src="{{ asset('storage/'.$posts[0]->image) }}"alt="{{ $posts[0]->category->name }}" class="img-fluid" width="1200x500">
            </div>
              @else
              <img src="https://source.unsplash.com/1200x500?{{ $posts[0]->category->name }}" class="card-img-top" alt="{{ $posts[0]->category->name }}">
              @endif
                <div class="card-body text-center">
                  <h5 class="card-title"><a href="/posts/{{ $posts[0]->slug }}" class="text-decoration-none text-dark">{{ $posts[0]->title }}</a></h5>
                  <p>
                    <small class="text-muted"> <a href="/posts?author={{ $posts[0]->author->username }}" class="text-decoration-none">{{ $posts[0]->author->name }}
                </a> in <a href="/posts?category={{ $posts[0]->category->slug }}" class="text-decoration-none">{{ $posts[0]->category->name }}</a>
           {{ $posts[0]->created_at->diffForHumans() }} </small>
        </p>
                  <p class="card-text">{{ $posts[0]->excerpt }}</p>
                  <a href="/posts/{{ $posts[0]->slug }}" class="text-decoration-none btn btn-success">Read More</a>
                </div>
              </div>
            </div>


<div class="container">
    <div class="row">
        @foreach ($posts->skip(1) as $post)
        <div class="col-md-4">
            <div class="card">
            <div class="position-absolute px-3 py-2" style="background-color:rgba(0, 0, 0, 0.5)"><a href="/posts?category={{ $post->category->slug }}" class="text-decoration-none text-white">{{ $post->category->name }}</a></div>
            @if ($post->image) 
            <div style="max-height: 350px; overflow:hidden;" >
            <img src="{{ asset('storage/'.$post->image) }}"alt="{{ $post->category->name }}" class="img-fluid">
          </div>
            @else
            <img src="https://source.unsplash.com/1200x500?{{ $post->category->name }}"alt="{{ $post->category->name }}" class="img-fluid"> 
            @endif
                <div class="card-body">
                  <h5 class="card-title">{{ $post->title }}</h5>
                  <p>
                    <small class="text-muted"> <a href="/posts?author={{ $post->author->username }}" 
                        class="text-decoration-none">{{ $post->author->name }}
                </a> {{ $post->created_at->diffForHumans() }} </small>
            </p>
                  <p class="card-text">{{ $post->excerpt }}</p>
                  <a href="/posts/{{ $post->slug }}" class="btn btn-success">Read More</a>
                </div>
              </div>
        </div>
        @endforeach
    </div>
</div>

    
@else 
<p class="text-center fs-4">No Post Found</p>
@endif
<div class="container d-flex justify-content-center mt-3">
{{ $posts->links() }}
</div>
       
@endsection
      
