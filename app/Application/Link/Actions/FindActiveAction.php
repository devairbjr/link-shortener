<?php

namespace App\Application\Link\Actions;

use App\Application\Common\Models\AbstractAction;
use Illuminate\Http\Request;
use App\Domain\Entities\Link;
use Exception;
use Carbon\Carbon;


class FindActiveAction extends AbstractAction
{
    public function __invoke($shortUrl)
    {
        try {
            $now = Carbon::now()->toDateString();
            $link = Link::where('short_url', $shortUrl)
                ->where('expires_at', '>=', $now)
                ->first();
            return $link;
        } catch (\Exception $error) {
            return response()->json(['errors' => $error->getMessage()], 409);
        }
    }

}
