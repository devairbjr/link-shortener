<?php

namespace App\Application\Link\Actions;

use App\Application\Common\Models\AbstractAction;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Domain\Entities\Link;
use Exception;


class FindAction extends AbstractAction
{
    public function __invoke(Request $request)
    {
        try {
            $longUrl = $request->long_url;
            $link = Link::where('long_url', $longUrl)->first();
            return $link;
        } catch (\Exception $error) {
            return response()->json(['errors' => $error->getMessage()], 409);
        }
    }

}
