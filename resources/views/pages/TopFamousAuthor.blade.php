@extends('layouts.Base')


@section('content')
    <section class="container">
        {{-- title --}}
        <div class="row my-5">
            <div class="col">
                <h1>Top 10 Author</h1>
            </div>
        </div>
        {{-- table --}}
        <div class="row mt-5">
            {{-- book table --}}
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Author Name</th>
                        <th scope="col">Voter</th>
                        <th scope="col">Average</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $rowNumber = 1;
                    @endphp
                
                    @foreach ($books as $book)
                        <tr>
                            <th scope="row">{{ $rowNumber++ }}</th>
                            <td>{{ $book->author->name }}</td>
                            <td>{{ $book->rating_count }}</td>
                            <td>{{ $book->rating_average }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection