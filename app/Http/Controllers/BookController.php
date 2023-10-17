<?php

namespace App\Http\Controllers;

use App\Helpers\Connector;
use App\Http\Requests\CreateBookRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BookController extends Controller
{
    public function __construct(
        public Connector $connector
    ) {}

    /**
     * @param string|null $book
     * @return View
     */
    public function single(string $book = null): View
    {
        $route = route('books.create');
        $authors = $this->connector->connect('get', 'authors');
        $response = [
            'author' => ['id' => 0],
            'id' => 0,
            'title' => '',
            'release_date' => '',
            'description' => '',
            'isbn' => '',
            'format' => '',
            'number_of_pages' => 0,
        ];

        if (!is_null($book)) {
            $route = '';
            $response = $this->connector->connect('get', 'books/' . $book);
        }

        return view('pages.books.single', [
            'route' => $route,
            'authors' => $authors['items'],
            'data' => $response
        ]);
    }

    public function create(CreateBookRequest $request): RedirectResponse
    {
        $this->connector->connect('post', 'books', $request->data());

        return redirect(route('authors.list'));
    }

    /**
     * @param string $book_id
     * @return RedirectResponse
     */
    public function delete(string $book_id): RedirectResponse
    {
        $this->connector->connect('delete', 'books/' . $book_id);

        return redirect()->back();
    }
}
