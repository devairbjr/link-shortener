<?php

namespace App\Api\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Application\Link\Actions\CreateOrUpdateAction;
use App\Application\Link\Actions\RedirectToLinkAction;
use Carbon\Carbon;
use Validator;

class LinkController extends Controller
{
    public function createOrUpdate(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'long_url' => 'required | url'
        ]);
        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 409);
        }
        return (new CreateOrUpdateAction())($request);
    }
    public function redirectToLink($short_url)
    {
        return (new RedirectToLinkAction())($short_url);
    }
}
