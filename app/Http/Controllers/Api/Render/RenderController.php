<?php

namespace App\Http\Controllers\Api\Render;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiController;
class RenderController extends Controller
{
    public function render(Request $request){
        $ApiController=new ApiController();
        $folders=$ApiController->findData($request);

    }
}
