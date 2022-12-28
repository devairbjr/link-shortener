<?php

namespace App\Api\Http\Controllers;

use App\Api\Http\Requests\LinkRequest;
use Illuminate\Http\Response;
use App\Application\Link\Actions\CreateOrUpdateAction;
use App\Application\Link\Actions\RedirectToLinkAction;
use App\Domain\Entities\Link;

class LinkController extends Controller
{
    public function createOrUpdate(LinkRequest $request)
    {
        $longUrl = $request->long_url;
        return (new CreateOrUpdateAction())($longUrl);
    }
    public function redirectToLink($short_url)
    {
        return (new RedirectToLinkAction())($short_url);
    }
}
