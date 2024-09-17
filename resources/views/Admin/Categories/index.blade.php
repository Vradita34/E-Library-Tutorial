<x-layout-backend>
    <section class="section">
        <div class="row" id="table-borderless">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Data Category</h4>
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
                                        <th>Name</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($categories as $category)
                                    <tr>
                                        <td class="text-bold-500">{{$loop->iteration}}</td> 
                                        <td>{{$category->name}}</td>
                                        <td>
                                            <a href="{{route('categories.edit',$category->id)}}">
                                                <button class="btn-warning">Edit</button>
                                            </a>
                                            <form action="{{route('categories.destroy',$category->id)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                        <h1>Category Empty</h1>
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
