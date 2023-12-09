@extends('layouts.Base')

@section('content')
    <section class="container">
        {{-- title --}}
        <div class="row my-5">
            <div class="col">
                <h1>Insert Rating</h1>
                <p class="note">*Note: Choose author name first</p>
            </div>
        </div>

        {{-- success message --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- error message --}}
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        {{-- form --}}
        <form action="{{ url('/rating/add') }}" method="post">
            @csrf
            <div class="input-group">
                <div class="row mb-3">
                    <div class="col-12">
                        <label for="book_id" class="form-label">Book Name</label>
                        <select name="book_id" id="book-id" class="form-select">
                            @foreach ($books as $book)
                                <option value="{{ $book->id }}">{{ $book->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="input-group">
                <div class="row mb-3">
                    <div class="col-12">
                        <label for="author_id" class="form-label">Author Name</label>
                        <select name="author_id" id="author-id" class="form-select">
                            @foreach ($authors as $author)
                                <option value="{{ $author->id }}">{{ $author->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="input-group row mb-3">
                <div class="row mb-4">
                    <div class="col-4">
                        <label for="rating" class="form-label">Rating</label>
                        <select name="rating" id="rating" class="form-select">
                            @for ($i = 1; $i <= 10; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
            </div>
            <div class="col m-0">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>

        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script>
            $(document).ready(function () {
                // Ketika dropdown penulis berubah
                $('#author-id').on('change', function () {
                    var authorId = $(this).val();
    
                    // Mengambil data buku berdasarkan penulis yang dipilih
                    $.ajax({
                        url: '/get-books-by-author/' + authorId,
                        type: 'GET',
                        success: function (data) {
                            // Menghapus opsi lama
                            $('#book-id').empty();
    
                            // Menambahkan opsi baru
                            $.each(data.books, function (key, value) {
                                $('#book-id').append('<option value="' + value.id + '">' + value.title + '</option>');
                            });
                        }
                    });
                });
            });
        </script>
    </section>

    

@endsection
