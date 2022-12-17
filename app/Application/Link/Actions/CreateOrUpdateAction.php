<?php

namespace App\Application\Link\Actions;

use App\Application\Common\Models\AbstractAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Domain\Entities\Link;
use Exception;

class CreateOrUpdateAction extends AbstractAction
{
    public function __invoke(Request $request)
    {
        try {
            $this->validate($request);

            $longUrl = $request->long_url;
            $customUrl = $request->custom_url;
            $now = Carbon::now()->toDateString();
            $linkByLongUrl = Link::where('long_url', $longUrl)->first();
            $linkByCustomUrl = Link::where('short_url', $customUrl)->first();

            if ($linkByLongUrl) {
                if ($linkByLongUrl->expires_at < $now) {
                    return response()->json(['message' => 'Link expired'], 409);
                }
                return response()->json([
                    'shortUrl' => $linkByLongUrl->short_url,
                ]);
            }
            if ($linkByCustomUrl) {
                return response()->json([
                    'message' => 'Custom Link not available',
                ]);
            }

            $shortUrl =
                $linkByCustomUrl == null
                    ? hash('crc32b', $request->long_url)
                    : $customUrl;

            $link = Link::upsert(
                [
                    'long_url' => $longUrl,
                    'short_url' => $shortUrl,
                    'expires_at' => Carbon::now()->addDays(7),
                ],
                ['short_url', 'long_url'],
                ['expires_at']
            );
            $link = Link::where('long_url', $longUrl)->first();

            return response()->json([
                'shortUrl' => $shortUrl,
            ]);
        } catch (\Exception $error) {
            return response()->json(['message' => $error->getMessage()], 409);
        }
    }

    protected function validate(Request $request)
    {
        $request->validate([
            'long_url' => 'required|url',
            'custom_url' => 'nullable|string',
        ]);
    }
}
