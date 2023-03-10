<?php

namespace App\Application\Link\Actions;

use App\Application\Common\Models\AbstractAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Domain\Entities\Link;
use App\Application\Link\Actions\FindActiveAction;
use Exception;

class RedirectToLinkAction extends AbstractAction
{
    public function __invoke($short_url)
    {
        try {
            $shortUrl = $short_url;
            $link =  (new FindActiveAction())($shortUrl);
            if (!$link) {
                return response()->json(['errors' => 'Link not found'], 409);
            }

            return header('Location: ' . $link->long_url, 301);
        } catch (\Exception $error) {
            return response()->json(['message' => $error->getMessage()], 409);
        }
    }

}
