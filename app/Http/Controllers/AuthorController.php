<?php

namespace App\Http\Controllers;

use App\Helpers\Connector;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AuthorController extends Controller
{
    public function __construct(
        public Connector $connector
    ) {}

    /**
     * @param array $query
     * @return View
     */
    public function list(Request $request): View
    {
        $query = $request->query();
        if (!isset($query['limit'])) {
            $query['limit'] = 6;
        }

        $response = $this->connector->connect('get', 'authors', $query);
        foreach ($response['items'] as &$author) {
            $author = $this->connector->connect('get', 'authors/' . $author['id']);
        }
        unset($author);

        return view('pages.authors.list', $response);
    }

    /**
     * @param string $author_id
     * @return View
     */
    public function single(string $author_id): View
    {
        $response = $this->connector->connect('get', 'authors/' . $author_id);

        return view('pages.authors.single', $response);
    }

    /**
     * @param string $author_id
     * @return RedirectResponse
     */
    public function delete(string $author_id): RedirectResponse
    {
        $this->connector->connect('delete', 'authors/' . $author_id);

        return redirect()->back();
    }
}
