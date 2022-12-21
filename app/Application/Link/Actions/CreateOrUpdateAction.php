<?php

namespace App\Application\Link\Actions;

use App\Application\Common\Models\AbstractAction;
use App\Application\Link\Actions\CreateAction;
use App\Application\Link\Actions\UpdateAction;
use App\Application\Link\Actions\FindAction;
use Illuminate\Http\Request;
use App\Domain\Entities\Link;
use Carbon\Carbon;
use Exception;

class CreateOrUpdateAction extends AbstractAction
{
    public function __invoke(Request $request)
    {
        try {
            $link =  (new FindAction())($request);
            $now = Carbon::now()->toDateString();

            if ($link && $link->expires_at >= $now) {
                return response()->json([
                    'shortUrl' => $link->short_url,
                ]);
            }
            if ($link && $link->expires_at <= $now) {
                return response()->json([
                    'shortUrl' => (new UpdateAction())($link),
                ]);
            }
            return response()->json([
                'shortUrl' =>  (new CreateAction())($request),
            ]);
        } catch (\Exception $error) {
            return response()->json(['errors' => $error->getMessage()], 409);
        }
    }
}
