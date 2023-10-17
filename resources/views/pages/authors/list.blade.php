@extends('layouts.app')

@section('content')
    <div class="row flex-grow-1 align-items-center justify-content-center">
        <div class="col-lg-9 col-md-12">
            <a href="{{ route('books.single') }}" class="btn btn-success mb-3">
                New book
            </a>
            <div class="card bg-white border-1 mb-0">
                <div class="card-header bg-primary text-white">
                    Authors
                </div>
                <div class="card-body d-flex flex-column px-lg-5 py-lg-5">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Gender</th>
                                <th>Birthday</th>
                                <th>Place of birth</th>
                                <th>View</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $item)
                                <tr>
                                    <td>{{ $item['first_name'] . ' ' . $item['last_name'] }}</td>
                                    <td>{{ $item['gender'] }}</td>
                                    <td>{{ \Carbon\Carbon::make($item['birthday'])->format('d.m.Y') }}</td>
                                    <td>{{ $item['place_of_birth'] }}</td>
                                    <td>
                                        <a href="{{ route('authors.single', [$item['id']]) }}" class="btn btn-info">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                    <td>
                                        @if(count($item['books']) === 0)
                                            <form action="{{ route('authors.delete', [$item['id']]) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger" type="submit">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
                <div class="card-footer bg-primary">
                    <div class="row justify-content-center">
                        <a href="{{ route('authors.list', ['page' => 1]) }}" class="page-item col-auto">First</a>
                        @for($page = 1; $page <= $total_pages; $page++)
                            @if($page === 1)
                                @continue;
                            @endif
                            <a href="{{ route('authors.list', ['page' => $page]) }}" class="page-item col-auto ms-3">{{ $page }}</a>
                            @if($page === $total_pages || $page > $total_pages)
                                @continue;
                            @endif
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
