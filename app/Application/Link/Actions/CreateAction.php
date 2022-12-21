<?php

namespace App\Application\Link\Actions;

use App\Application\Common\Models\AbstractAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Domain\Entities\Link;
use Exception;
use Illuminate\Support\Facades\Validator;


class CreateAction extends AbstractAction
{
    public function __invoke(Request $request)
    {
        try {

            $longUrl = $request->long_url;
            $shortUrl = hash('crc32b', $longUrl);
            $link = Link::create(
                [
                    'long_url' => $longUrl,
                    'short_url' => $shortUrl,
                    'expires_at' => Carbon::now()->addDays(7),
                ],
            );
            return $link->short_url;
        } catch (\Exception $error) {
            return response()->json(['errors' => $error->getMessage()], 409);
        }
    }
}
