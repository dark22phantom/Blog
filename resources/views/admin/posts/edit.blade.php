<x-admin-master>
    @section('content')
    <h1 class="h3 mb-4 text-gray-800">Edit a Post</h1>
    <form method="post" action="{{route('post.update',$post->id)}}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" id="title" value="{{$post->title}}" placeholder="Enter Title">
        </div>
        <div class="form-group">
            <label for="body">Body</label>
            <textarea name="body" id="body" class="form-control" cols="30" rows="10">
                {{$post->body}}
            </textarea>
        </div>
        <div class="form-group">
            <div><img height="40px" src="{{$post->post_image}}"></div>
            <label for="image">Image</label>
            <input type="file" name="post_image" class="form-control-file" id="post_image" placeholder="">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    @endsection
</x-admin-master>