<x-admin-master>
    @section('content')
        <h1>All Posts</h1>
        @if (Session::has('alert-created'))
            <div class="alert alert-success">
              {{Session::get('alert-created')}}
            </div>
            
        @elseif(Session::has('alert-deleted'))
        <div class="alert alert-danger">
          {{Session::get('alert-deleted')}}
        </div>

        @elseif(Session::has('alert-updated'))
        <div class="alert alert-primary">
          {{Session::get('alert-updated')}}
        </div>
        @endif
        <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                        <th>No</th>
                        <th>Title</th>
                        <th>Body</th>
                        <th>Image</th>
                        <th>Created By</th>
                        <th>Created Date</th>
                        <th>Delete</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Title</th>
                        <th>Body</th>
                        <th>Image</th>
                        <th>Created By</th>
                        <th>Created Date</th>
                        <th>Delete</th>
                    </tr>
                  </tfoot>
                  <tbody>
                      <?php $no=1;?>
                      @foreach ($posts as $post)
                        <tr>
                            <td><?php echo $no; $no++?></td>
                            <td><a href="{{route('post.edit',$post->id)}}">{{$post->title}}</a></td>
                            <td>{{$post->body}}</td>
                            <td>
                                <img height="40px" src="{{$post->post_image}}">
                            </td>
                            <td>{{$post->user->name}}</td>
                            <td>{{$post->created_at->diffForHumans()}}</td>
                            <td>
                              <form method="POST" action="{{route('post.destroy', $post->id)}}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                              </form>
                            </td>
                        </tr>
                      @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
    @endsection

    @section('scripts')
        <!-- Page level plugins -->
        <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

        <!-- Page level custom scripts -->
        <script src="{{asset('js/datatables.js')}}"></script>
    @endsection
</x-admin-master>