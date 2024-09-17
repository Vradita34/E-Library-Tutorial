<x-layout_backend>
    <a href="{{route('books.create')}}">
        <button class="btn-outline-info">
            Add Books
        </button>
    </a>
    <section class="content-types">
        <div class="row">
            @forelse ($books as $book)
            <div class="col-xl-4 col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-content">
                        <img src="{{asset('storage/'.$book->cover)}}" class="card-img-top img-fluid" alt="singleminded">
                        <div class="card-body">
                            <h5 class="card-title">{{$book->title}}</h5>
                            <p class="card-text">
                                Chocolate sesame snaps apple pie danish cupcake sweet roll jujubes
                                tiramisu.Gummies
                                bonbon apple pie fruitcake icing biscuit apple pie jelly-o sweet roll.
                            </p>
                        </div>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            @foreach ($book->categories as $category)
                                <p class="badge bg-info">{{$category->name}}</p>
                            @endforeach
                        </li>
                        <li class="list-group-item flex">
                            <a href="{{route('books.edit',$book->id)}}">
                                <button class="btn-outline-warning btn">
                                    Edit
                                </button>
                            </a>
                            <form action="{{route('books.destroy',$book->id)}}" method="POST" onsubmit="onclick('are you sure delete this book!')">
                                @csrf
                                @method('DELETE')
                                <button class="btn-outline-danger btn">
                                    Delete
                                </button>
                            </form>
                        </li>
                        <li class="list-group-item">Vestibulum at eros</li>
                    </ul>
                </div>
            </div>
            @empty
            <div class="col-xl-4 col-md-6 col-sm-12">
                <h3>Book Empty</h3>
            </div>
            @endforelse
        </div>
    </section>
</x-layout_backend>
