<?php

namespace App\Application\Link\Actions;

use App\Application\Common\Models\AbstractAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Domain\Entities\Link;
use Exception;

class RedirectToLinkAction extends AbstractAction
{
    public function __invoke($short_url)
    {
        try {
            $shortUrl = $short_url;
            $now = Carbon::now()->toDateString();
            $link = Link::where('short_url', $shortUrl)
                ->where('expires_at', '>=', $now)
                ->first();
            if (!$link) {
                return response()->json(['message' => 'Link not found'], 409);
            }
            header('Location: ' . $link->long_url, 301);
            return die();
        } catch (\Exception $error) {
            return response()->json(['message' => $error->getMessage()], 409);
        }
    }
    protected function validate(Request $request)
    {
    }
}
