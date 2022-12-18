<?php

namespace App\Application\Link\Actions;

use App\Application\Common\Models\AbstractAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Domain\Entities\Link;
use Exception;
use Illuminate\Support\Facades\Validator;


class CreateOrUpdateAction extends AbstractAction
{
    public function __invoke(Request $request)
    {
        try {
            $validate = $this->validate($request);

            if($validate->fails()){
                return response()->json(['message' => $validate->errors()], 409);
            }

            $longUrl = $request->long_url;
            $now = Carbon::now()->toDateString();
            $linkByLongUrl = Link::where('long_url', $longUrl)->first();

            if ($linkByLongUrl && $linkByLongUrl->expires_at >= $now) {
                return response()->json([
                    'shortUrl' => $linkByLongUrl->short_url,
                ]);
            }
            $shortUrl = hash('crc32b', $request->long_url);

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
                'shortUrl' => $link->short_url,
            ]);
        } catch (\Exception $error) {
            return response()->json(['message' => $error->getMessage()], 409);
        }
    }

    protected function validate(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'long_url' => 'required | url'
        ]);
        return $validator;
    }
}
