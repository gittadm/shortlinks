<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLinkRequest;
use App\Services\LinkService;
use Illuminate\Support\Facades\Redirect;

class LinkController extends Controller
{
    private $linkService;

    /**
     * @param LinkService $linkService
     */
    public function __construct(LinkService $linkService)
    {
        $this->linkService = $linkService;
    }

    /**
     * Create short link
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Create short link by original link
     *
     * @param StoreLinkRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreLinkRequest $request)
    {
        $shortLink = $this->linkService->store($request->input('url'));

        return response()->json([
            'success' => true,
            'data' => $shortLink
        ]);
    }

    /**
     * Redirect to original link by short link
     *
     * @param string $key
     * @return \Illuminate\Http\RedirectResponse|string
     */
    public function redirectToLink(string $key)
    {
        $link = $this->linkService->getLinkByKey($key);

        if ($link) {
            return Redirect::to($link->link);
        }

        return 'Ссылка не найдена';
    }
}
