@extends('layouts.master')

@section('content')
    <h1 class="text-danger"> Index Page</h1>

@if(Auth::user()->is_admin)

    <a href="{{ route('books.create') }}" class="btn btn-outline-success">Create</a>


@endif

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">NameOfBook</th>
                <th scope="col">AutherName</th>
                <th scope="col">PlaceOfPuplication</th>
                <th scope="col">Operations</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($books as $book)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>

                    <td>{{ $book->name_book}}</td>
                    <td>{{ $book->auther_name}}</td>
                    <td>{{ $book->place_of_publication }}</td>
@if(Auth::user()->is_admin)
                   <td>
                        <div class="d-flex">
                            <form action="{{ route('books.edit' , ['book' => $book->id]) }}" method="GET">
                                @csrf
                                <button class="btn btn-sm btn-info">Edit</button>
                            </form>


                            <form class="ms-2" action="{{ route('books.destroy', ['book' => $book->id]) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button class="btn btn-sm btn-danger">Delete</button>

                            </form>
                        </div>
                    </td>
                    @else
                    <td>
                        <form class="ms-2" action="{{ route('books.destroy', ['book' => $book->id]) }}" method="POST">
                            @csrf

                            <button class="btn btn-sm btn-info">Select</button>

                        </form>
                    </td>

@endif

                </tr>
            @empty

            @endforelse

        </tbody>
    </table>
@endsection
