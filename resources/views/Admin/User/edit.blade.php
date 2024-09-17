<x-layout_backend>
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit User</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" action="{{route('user.update',$user->id)}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT'); 
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">Avatar  ( Optional )</label>
                                            <input type="file" id="first-name-column" class="form-control" placeholder="Avatar" name="avatar" value="{{old('avatar')}}">
                                        </div>
                                        @error('avatar')
                                            <p class="text-warning text-small">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">Username</label>
                                            <input type="text" id="first-name-column" class="form-control" placeholder="Username" name="username" value="{{old('username',$user->username)}}">
                                        </div>
                                        @error('username')
                                            <p class="text-warning text-small">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column">Name</label>
                                            <input type="text" id="last-name-column" class="form-control"  placeholder="Name" name="name" value="{{old('name',$user->name)}}">
                                        </div>
                                        @error('name')
                                            <p class="text-warning text-small">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="city-column">Email</label>
                                            <input type="text" id="city-column" class="form-control" placeholder="Email" name="email" value="{{$user->email}}" readonly>
                                        </div>
                                        @error('email')
                                            <p class="text-warning font-small">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <h6>Role</h6>
                                        <div class="input-group mb-3">
                                            <select class="form-select" id="inputGroupSelect01" name="role">
                                                <option value="librarian" {{$user->role == 'librarian' ? 'selected' : ''}}>Librarian</option>
                                                <option value="admin" {{$user->role == 'admin' ? 'selected' : ''}}>Admin</option>
                                                <option value="reader" {{$user->role == 'reader' ? 'selected' : ''}}>Reader</option>
                                            </select>
                                            <label class="input-group-text" for="inputGroupSelect01">Options</label>
                                            @error('role')
                                                <p class="text-warning font-small">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>                                    
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="country-floating">Address</label>
                                            <textarea  name="address"id="address" cols="30" rows="10" class="form-control">{{old('address',$user->address)}}</textarea>
                                        </div>
                                        @error('address')
                                            <p class="text-warning font-small">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                        <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layout_backend>