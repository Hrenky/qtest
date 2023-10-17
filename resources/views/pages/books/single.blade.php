@extends('layouts.app')

@section('content')
    <div class="row flex-grow-1 align-items-center justify-content-center">
        <div class="col-lg-9 col-md-12">
            <form class="card bg-white border-1 mb-0" action="{{ $route }}" method="post">
                @csrf
                <div class="card-header bg-primary text-white">
                    Book: {{ $data['id'] }}
                </div>
                <div class="card-body d-flex flex-column px-lg-5 py-lg-5">
                    <div class="row mb-3">
                        <label for="author" class="col-3">Author</label>
                        <div class="col-9">
                            <select id="author" name="author">
                                @foreach($authors as $author)
                                    <option value="{{ $author['id'] }}" @selected(old('author') == $author['id'])>{{ $author['first_name'] . ' ' . $author['last_name'] }}</option>
                                @endforeach
                            </select>
                            @error('author')
                                <div class="invalid-feedback">{{ $errors->first('author') }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3 form-group">
                        <label for="title" class="col-3">Title</label>
                        <div class="col-9">
                            <input id="title" name="title" value="{{ old('title') }}">
                            @error('title')
                                <div class="invalid-feedback">{{ $errors->first('title') }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="release_date" class="col-3">Release date</label>
                        <div class="col-9">
                            <input id="release_date" name="release_date" type="date" value="{{ old('release_date') }}">
                            @error('release_date')
                                <div class="invalid-feedback">{{ $errors->first('release_date') }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="description" class="col-3">Description</label>
                        <div class="col-9">
                            <textarea id="description" name="description">{{ trim(old('description')) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $errors->first('description') }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="isbn" class="col-3">Isbn:</label>
                        <div class="col-9">
                            <input id="isbn" name="isbn" value="{{ old('isbn') }}">
                            @error('isbn')
                                <div class="invalid-feedback">{{ $errors->first('isbn') }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="format" class="col-3">Format:</label>
                        <div class="col-9">
                            <input id="format" name="format" value="{{ old('format') }}">
                            @error('format')
                                <div class="invalid-feedback">{{ $errors->first('format') }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <label for="number_of_pages" class="col-3">Pages #:</label>
                        <div class="col-9">
                            <input id="number_of_pages" name="number_of_pages" value="{{ old('number_of_pages') }}">
                            @error('number_of_pages')
                                <div class="invalid-feedback">{{ $errors->first('number_of_pages') }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-primary">
                    <button class="btn btn-info" type="submit">Create</button>
                </div>
            </form>
        </div>
    </div>
@endsection
