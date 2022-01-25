<?php

namespace Codecycler\Cms\Http\Controllers;

use Illuminate\Http\Request;
use Codecycler\Cms\Models\Page;
use Illuminate\Routing\Controller;

class CmsController extends Controller
{
    public function run(Request $request)
    {
        // Check if there is a page for the requested route
        $page = Page::findByUrl($request->getRequestUri());

        if ($page) {
            return view('theme/page', [
                'page' => $page,
            ]);
        }

        abort(404);
    }
}