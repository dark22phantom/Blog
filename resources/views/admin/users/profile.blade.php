<x-admin-master>
    @section('content')
        <h1>User Profile {{$user->name}}</h1>
        <div class="row">
            <div class="col-sm-6">
                <form method="post" action="{{route('user.profile.update',$user)}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <img height="50px" width="50px" class="img-profile rounded-circle" src="{{$user->avatar}}">
                    </div>
                    <div class="form-group">
                        <input type="file" name="avatar" class="form-control-file" id="avatar" placeholder="">
                    </div>
                    @error('avatar')
                        <div class="alert alert-danger">{{$message}}</div>
                    @enderror

                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="username" value="{{$user->username}}">

                        @error('username')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{$user->name}}">

                        @error('name')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{$user->email}}">

                        @error('email')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password">

                        @error('password')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Confirm Passsword</label>
                        <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation">

                        @error('password_confirmation')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
        @if(auth()->user()->userHasRole('admin'))
        <div class="row">
            <div class="col-sm-12">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="roles-user-table" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Attach</th>
                                    <th>Detach</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Attach</th>
                                    <th>Detach</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php $no=1;?>
                                @foreach ($roles as $role)
                                    <tr>
                                        <td><input type="checkbox" name="" id=""
                                        @if ($user->roles->contains($role))
                                            checked
                                        @endif
                                        ></td>
                                        <td><?php echo $no; $no++?></td>
                                        <td>{{$role->name}}</td>
                                        <td>{{$role->slug}}</td>
                                        <td>                                               
                                            <form method="POST" action="{{route('user.role.attach',$user->id)}}">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="role" value="{{$role->id}}">
                                                <button class="btn btn-primary"
                                                @if ($user->roles->contains($role))
                                                    disabled
                                                @endif
                                                >Attach</button>
                                            </form>
                                        </td>
                                        <td>
                                            <form method="POST" action="{{route('user.role.detach',$user->id)}}">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="role" value="{{$role->id}}">
                                                <button class="btn btn-danger"
                                                @if (!$user->roles->contains($role))
                                                    disabled
                                                @endif
                                                >Detach</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endif
    @endsection

    @section('scripts')
        <!-- Page level plugins -->
        <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

        <!-- Page level custom scripts -->
        <script src="{{asset('js/datatables.js')}}"></script>
    @endsection
</x-admin-master>