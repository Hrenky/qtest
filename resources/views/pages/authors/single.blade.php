@extends('layouts.app')

@section('content')
    <div class="row flex-grow-1 align-items-center justify-content-center">
        <div class="col-lg-9 col-md-12">
            <div class="card bg-white border-1 mb-0">
                <div class="card-header bg-primary text-white">
                    Author: {{ $first_name }} {{ $last_name }}
                </div>
                <div class="card-body d-flex flex-column px-lg-5 py-lg-5">
                    <div class="row">
                        <div class="col-3">First name:</div>
                        <div class="col-9">{{ $first_name }}</div>
                    </div>
                    <div class="row">
                        <div class="col-3">Last name:</div>
                        <div class="col-9">{{ $last_name }}</div>
                    </div>
                    <div class="row">
                        <div class="col-3">Gender:</div>
                        <div class="col-9">{{ $gender }}</div>
                    </div>
                    <div class="row">
                        <div class="col-3">Birthday:</div>
                        <div class="col-9">{{ \Carbon\Carbon::make($birthday)->format('d.m.Y') }}</div>
                    </div>
                    <div class="row">
                        <div class="col-3">Place of birth:</div>
                        <div class="col-9">{{ $place_of_birth }}</div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12 mb-3">
                            <span>Books:</span>
                            <a href="{{ route('books.single') }}" class="btn btn-success ms-3">
                                New book
                            </a>
                        </div>
                        <div class="col-12">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Release date</th>
                                    <th>Description</th>
                                    <th>ISBN</th>
                                    <th>Format</th>
                                    <th>Pages #</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($books as $book)
                                        <tr>
                                            <td>{{ $book['title'] }}</td>
                                            <td>{{ \Carbon\Carbon::make($book['release_date'])->format('d.m.Y') }}</td>
                                            <td>{{ $book['description'] }}</td>
                                            <td>{{ $book['isbn'] }}</td>
                                            <td>{{ $book['format'] }}</td>
                                            <td>{{ $book['number_of_pages'] }}</td>
                                            <td>
                                                <form action="{{ route('books.delete', [$book['id']]) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger" type="submit">
                                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                                    </button>
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
        </div>
    </div>
@endsection
