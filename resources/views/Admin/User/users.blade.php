<x-layout-backend>
    <section class="section">
        <div class="row" id="table-borderless">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Data User</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                        </div>
                        <!-- table with no border -->
                        <div class="table-responsive">
                            <table class="table table-borderless mb-0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Avatar</th>
                                        <th>Email</th>
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Address</th>
                                        <th>Role</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($users as $user)
                                    <tr>
                                        <td class="text-bold-500">{{$loop->iteration}}</td> 
                                        <td>
                                            <div class="avatar avatar-lg me-3">
                                                <img src="{{asset('storage/'.$user->avatar)}}" alt="avatar" srcset="">
                                            </div>
                                        </td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->username}}</td>
                                        <td>{{$user->address}}</td>
                                        <td class="text-bold-500">{{$user->role}}</td>
                                        <td>
                                            <a href="{{route('user.edit',$user->id)}}">
                                                <button class="btn-warning">Edit</button>
                                            </a>
                                            <form action="{{route('user.destroy',$user->id)}}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                        <h1>User Empty</h1>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layout-backend>
