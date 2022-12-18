<?php

namespace App\Api\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Application\Link\Actions\CreateOrUpdateAction;
use App\Application\Link\Actions\RedirectToLinkAction;
use Carbon\Carbon;
use Validator;

class LinkController extends Controller
{
    public function createOrUpdate(Request $request)
    {
        return (new CreateOrUpdateAction())($request);
    }
    public function redirectToLink($short_url)
    {
        return (new RedirectToLinkAction())($short_url);
    }
}
