<x-layout_backend>
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Add Books</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" action="{{ route('books.update',$book->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <!-- Cover Input -->
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="cover">Cover (Optional)</label>
                                            <input type="file" id="cover" class="form-control" name="cover">
                                        </div>
                                        @error('cover')
                                            <p class="text-warning text-small">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Title Input -->
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="title">Title</label>
                                            <input type="text" id="title" class="form-control" placeholder="Title" name="title" value="{{ old('title',$book->title) }}">
                                        </div>
                                        @error('title')
                                            <p class="text-warning text-small">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Author Input -->
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="author">Author</label>
                                            <input type="text" id="author" class="form-control" placeholder="Author" name="author" value="{{ old('author',$book->author) }}">
                                        </div>
                                        @error('author')
                                            <p class="text-warning text-small">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Synopsis Input -->
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="synopsis">Synopsis</label>
                                            <textarea name="synopsis" id="synopsis" cols="30" rows="10" class="form-control">{{ old('synopsis',$book->synopsis) }}</textarea>
                                        </div>
                                        @error('synopsis')
                                            <p class="text-warning text-small">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Release Date Input -->
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="release_date">Release Date</label>
                                            <input type="date" id="release_date" class="form-control" name="release_date" value="{{ date('Y-m-d',strtotime($book->release_date))}}">
                                        </div>
                                        @error('release_date')
                                            <p class="text-warning text-small">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- File Input -->
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="file">File</label>
                                            <input type="file" id="file" class="form-control" name="file">
                                        </div>
                                        @error('file')
                                            <p class="text-warning text-small">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="integer">Read Duration</label>
                                            <input type="number" value="{{old('read_duratioin',$book->read_duration) }}" id="read_duration" class="form-control" name="read_duration" min="1" max="14" >
                                        </div>
                                        @error('read_duration')
                                            <p class="text-warning text-small">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Categories Input -->
                                    <div class="col-md-6 mb-4">
                                        <h6>Categories</h6>
                                        <div class="form-group">
                                            <select class="choices form-select multiple-remove" multiple="multiple" name="categories[]">
                                                <optgroup label="Categories">
                                                    @foreach ($categories as $category)
                                                        <option
                                                            value="{{ $category->id }}
                                                            {{in_array($category->id,old('categories',$book->categories->pluck('id')->toArray())) ? 'selected' : ''}}
                                                        ">
                                                            {{ $category->name }}
                                                        </option>
                                                    @endforeach
                                                </optgroup>
                                            </select>
                                        </div>
                                        @error('categories')
                                            <p class="text-warning text-small">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Submit and Reset buttons -->
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
