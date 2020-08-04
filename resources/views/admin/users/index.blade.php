<x-admin-master>
    @section('content')
        <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h4 class="m-0 font-weight-bold text-primary">All Users</h4>
            </div>
            @if (Session::has('alert-deleted'))
            <div class="alert alert-danger">
              {{Session::get('alert-deleted')}}
            </div>
            @endif
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="users-table" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                        <th>No</th>
                        <th>Avatar</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Created Date</th>
                        <th>Delete</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Avatar</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Created Date</th>
                        <th>Delete</th>
                    </tr>
                  </tfoot>
                  <tbody>
                      <?php $no=1;?>
                      @foreach ($users as $user)
                        <tr>
                            <td><?php echo $no; $no++?></td>
                            <td><img class="img-profile rounded-circle" height="50px" width="50px" src="{{$user->avatar}}"></td>
                            <td>{{$user->name}}</td>
                            <td><a href="{{route('user.profile.show', $user->id)}}">{{$user->username}}</a></td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->created_at}}</td>
                            <td>
                                @if ($user->id != auth()->user()->id)
                                <a class="btn btn-danger" href="#" data-toggle="modal" data-target="#deleteModal">Delete</a>
                                    
                                @endif
                            </td>
                        </tr>
                      @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>

      <!-- Delete Modal-->
      <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">Are you sure want to delete <strong>{{$user->name}}</strong> ?</div>
            <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
              <form method="POST" action="{{route('user.destroy', $user)}}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
              </form>
            </div>
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