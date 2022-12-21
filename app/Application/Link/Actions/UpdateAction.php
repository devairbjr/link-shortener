<?php

namespace App\Application\Link\Actions;

use App\Application\Common\Models\AbstractAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Domain\Entities\Link;
use Exception;
use Illuminate\Support\Facades\Validator;

class UpdateAction extends AbstractAction
{
    public function __invoke($link)
    {
        try {
            $link->expires_at = Carbon::now()->addDays(7);
            $link->save();

            return $link->short_url;
        } catch (\Exception $error) {
            return response()->json(['errors' => $error->getMessage()], 409);
        }
    }

}
