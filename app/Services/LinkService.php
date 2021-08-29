<?php

namespace App\Services;

use App\Exceptions\LimitException;
use App\Models\Link;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LinkService
{
    /**
     * Get full link data by key
     *
     * @param string $key
     * @return Link|null
     */
    public function getLinkByKey(string $key): ?Link
    {
        return Link::where('short_link', Str::lower($key))->first();
    }

    /**
     * Get short link by key
     *
     * @param string $key
     * @return string
     */
    private function getShortLink(string $key): string
    {
        return Str::finish(config('app.url'), '/') . $key;
    }

    /**
     * Gen key for short link (check length limit)
     *
     * @return string
     * @throws LimitException
     */
    private function genShortLinkKey(): string
    {
        $len = DB::select( DB::raw("SELECT max(length(short_link)) AS len FROM links"))[0]->len;

        if (!$len) {
            $len = 1;
            $maxCount = 9;
            $count = 0;
        } else {
            $maxCount = pow(Link::SYMBOLS_COUNT, $len);
            $count = DB::table('links')->whereRaw('length(short_link) = ?', [$len])->count();
        }

        if ($count === $maxCount) {
            if ($len === Link::MAX_LEN) {
                throw new LimitException();
            } else {
                $len++;
            }
        }

        do {
            $shortLink = Str::lower(Str::random($len));
        } while (Link::where('short_link', $shortLink)->exists());

        return $shortLink;
    }

    /**
     * Store short link by original link
     *
     * @param string $url
     * @return string
     * @throws LimitException
     */
    public function store(string $url): string
    {
        $url = Str::finish(Str::lower($url), '/');
        $link = Link::where('link', $url)->first();

        if ($link) {
            return $this->getShortLink($link->short_link);
        }

        $shortLink = $this->genShortLinkKey();

        Link::create([
            'link' => $url,
            'short_link' => $shortLink
        ]);

        return $this->getShortLink($shortLink);
    }
}
