<?php

namespace App\Application\Link\Actions;

use App\Application\Common\Models\AbstractAction;
use App\Application\Link\Actions\CreateAction;
use App\Application\Link\Actions\UpdateAction;
use App\Application\Link\Actions\FindAction;
use Illuminate\Http\Request;
use App\Domain\Entities\Link;
use Exception;

class CreateOrUpdateAction extends AbstractAction
{
    public function __invoke($longUrl)
    {
        try {
            $link =  (new FindAction())($longUrl);
            $isActive = (new Link())->isActive($link);
            if ($isActive) {
                return response()->json([
                    'shortUrl' => $link->short_url,
                ]);
            }
            if (!$isActive) {
                return response()->json([
                    'shortUrl' => (new UpdateAction())($link),
                ]);
            }
            return response()->json([
                'shortUrl' =>  (new CreateAction())($longUrl),
            ]);
        } catch (\Exception $error) {
            return response()->json(['errors' => $error->getMessage()], 409);
        }
    }
}
