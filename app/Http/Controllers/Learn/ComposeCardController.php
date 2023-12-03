<?php

namespace App\Http\Controllers\Learn;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ComposeCardController extends Controller
{
    public function getCardArray(int $cur_card_num, int $cards_amount, $learn_service){
        $main =$learn_service->getCards($cur_card_num, $cards_amount);
        return $main;
    }
}
