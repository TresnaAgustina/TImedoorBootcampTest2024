@extends('layouts.Base')

@section('content')
    <div class="container p-0">
        <div class="row mt-5">
            <div class="col">
                <h1>Dashboard</h1>
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
        
        {{-- button group --}}
        <div class="row mb-5">
            <div class="col p-0">
                <a href="/top-author" class="btn btn-link">Top Author</a>
                <span>|</span>
                <a href="/rating" class="btn btn-link">Insert Rating</a>
            </div>
        </div>
        
        {{-- search group --}}
        <div class="row">
            <form action="/search" method="post">
                @csrf
                <div class="input-group mb-3 row">
                        <div class="col-4">
                            <label for="post-count" class="form-label">List Down</label>
                            <select name="post-count" class="form-select">
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="30">30</option>
                                <option value="40">40</option>
                                <option value="50">50</option>
                                <option value="60">60</option>
                                <option value="70">70</option>
                                <option value="80">80</option>
                                <option value="90">90</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="input-group row mb-3">
                    <div class="row">
                        <div class="col-4">
                            <label for="search-text" class="form-label">Search</label>
                            <input name="search-text" type="text" class="form-control" id="search-text" value="{{ old('search-text') }}">
                        </div>
                    </div>
                </div>

                <div class="col m-0">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>

        <div class="row mt-5">
            {{-- book table --}}
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Book Name</th>
                        <th scope="col">Category Name</th>
                        <th scope="col">Author Name</th>
                        <th scope="col">Average Rating</th>
                        <th scope="col">Voter</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $book)
                        <tr>
                            <th scope="row">{{ ($books->currentPage() - 1) * $books->perPage() + $loop->iteration }}</th>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->category->name}}</td>
                            <td>{{ $book->author->name }}</td>
                            <td>{{ $book->rating_average }}</td>
                            <td>{{ $book->rating_count }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    @if($books->onFirstPage())
                        <li class="page-item disabled"><span class="page-link">Previous</span></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $books->previousPageUrl() }}" aria-label="Previous">Previous</a></li>
                    @endif
            
                    @if($books->currentPage() > 3)
                        <li class="page-item"><span class="page-link">...</span></li>
                    @endif
            
                    @for ($i = max(1, $books->currentPage() - 2); $i <= min($books->currentPage() + 2, $books->lastPage()); $i++)
                        <li class="page-item{{ ($books->currentPage() == $i) ? ' active' : '' }}">
                            <a class="page-link" href="{{ $books->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor
            
                    @if($books->currentPage() < $books->lastPage() - 2)
                        <li class="page-item"><span class="page-link">...</span></li>
                    @endif
            
                    @if($books->hasMorePages())
                        <li class="page-item"><a class="page-link" href="{{ $books->nextPageUrl() }}" aria-label="Next">Next</a></li>
                    @else
                        <li class="page-item disabled"><span class="page-link">Next</span></li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>
@endsection
