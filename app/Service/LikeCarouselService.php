<?php
/**
 * Created by PhpStorm.
 * User: triest
 * Date: 29.08.2020
 * Time: 11:20
 */

namespace App\Service;


use App\Models\City;
use App\Models\Lk\User;
use App\Models\SearchSettings;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LikeCarouselService
{

    public function getAnket($userAuth = null)
    {
        $user = User::select(['*']);

        $city = City::getCurrentCity();

        if ($city == null) {
            return null;
        }

        $user->where('city_id', '=', $city->id);

        $user->with(['target', 'relation', 'interest', 'city']);

        $authUser = Auth::user();
        if ($authUser) {
            $user->where('id', '!=', $authUser->id);
        }

        $searchSettings = SearchSettings::getSearchSettings();

        if ($searchSettings && $searchSettings->meet != null && $searchSettings->meet != "nomatter") {
            $user->where('sex', '=', $searchSettings->meet);
        }

        $user = $user->inRandomOrder()->first();

        if ($user == null && $searchSettings && $searchSettings->meet != null && $searchSettings->meet != "nomatter") {
            $user = User::select(['*'])->where('city_id', '=', $city->id)->where(
                    'sex',
                    '=',
                    $searchSettings->meet
            )->inRandomOrder()->with(['target', 'relation', 'interest', 'city'])->first();
        }


        if ($user == null && $searchSettings && $searchSettings->meet != null && $searchSettings->meet != "nomatter") {
            $user = User::select(['*'])->inRandomOrder()->where('sex', '=', $searchSettings->meet)->with(
                    ['target', 'relation', 'interest', 'city']
            )->first();
        }

        return $user;
    }
}
