<?php

namespace App\Http\Controllers\Learn;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
class ComposeCardController extends Controller
{
    public function getCardArray(int $cur_card_num, int $cards_amount, $learn_service):array{
        return $learn_service->getCards($cur_card_num, $cards_amount);
    }
    public function getShuffledCardArray(int $cur_card_num, int $cards_amount, $learn_service):array{
        return $learn_service->getShuffledCards($cur_card_num, $cards_amount, $learn_service);
    }

}
