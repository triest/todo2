<?php
/**
 * Created by PhpStorm.
 * User: triest
 * Date: 05.09.2020
 * Time: 14:18
 */

namespace App\Service;


use App\Models\Interest;
use App\Models\SearchSettings;
use App\Models\Target;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SearchService
{
    private $limit = 9;

    private $paginate = 9;

    public function search()
    {
        $userAuth = Auth::user();
        $searchSettings = SearchSettings::getSearchSettings();

        if (!isset($searchSettings) || $searchSettings == null) {
            $users = DB::table('users');
            if (isset($userAuth) && $userAuth != null) {
                $users->where('city_id', '=', $userAuth->city_id);
            }


            $city = City::getCurrentCity();


            if ($city != null) {
                $users->where('city_id', $city->id);
            }

            if (Auth::user() != null) {
                $users->where('id', '!=', Auth::user()->id);
            }

            $count = $users->count();
            if (isset($_GET['page']) && intval($_GET['page']) > 1) {
                $page = intval($_GET['page']);
                $offset = $this->limit * ($page);
                $users->offset($offset);
            }

            $users->select(
                  '*'
            )->distinct('users.id')->limit($this->limit);


            $num_pages = intval($count / $this->limit);
            $users->limit($this->limit);
            $users->orderByDesc('created_at')->get();
            $users = $users->paginate($this->paginate);

            return $users;
        }

        $users = User::select(['*']);
/*
        $interest = $searchSettings->interest()->get();


        if ($interest->isNotEmpty()) {
            $users->leftJoin(
                    'user_interest',
                    'user_interest.user_id',
                    '=',
                    'users.id'
            );
            // надо плдучить массив id штеукуыщцж
            $interest_array = array();
            foreach ($interest as $item) {
                array_push($interest_array, $item->id);
            }

            $users->whereIn('user_interest.interest_id', $interest_array);
        }
*/
        /*
        $targets = $searchSettings->target()->get();

        if ($targets->isNotEmpty()) {
            $users->leftJoin(
                    'user_target',
                    'user_target.user_id',
                    '=',
                    'users.id'
            );
            // надо плдучить массив id штеукуыщцж
            $interest_array = array();
            foreach ($targets as $item) {
                array_push($interest_array, $item->id);
            }
            $users->whereIn('user_target.target_id', $interest_array);
        }


        if ($searchSettings->children != null && $searchSettings->children != 3) {
            $users->where('children_id', '=', $searchSettings->children);
        }
*/
/*
        $city = City::getCurrentCity();


        if ($city != null) {
            $users->where('city_id', $city->id);
        }
*/
        if ($searchSettings->meet != null
                && $searchSettings->meet != "nomatter"
        ) {
            $users->where('sex_id', '=', $searchSettings->meet);
        }

        if (isset($searchSettings) && $searchSettings->relation != 0) {
            $users->where('relation_id', '=', $searchSettings->relation);
        }

        if (isset($searchSettings) && $searchSettings->age_from != null) {
            $users->where(DB::raw(" TIMESTAMPDIFF(YEAR, date_birth,NOW())"), ">=", $searchSettings->age_from);
        }

        if (isset($searchSettings) && $searchSettings->age_to != null) {
            $users->where(DB::raw(" TIMESTAMPDIFF(YEAR, date_birth,NOW())"), "<=", $searchSettings->age_to);
        }

        if (Auth::user() != null) {
            $users->where('users.id', '!=', Auth::user()->id);
        }


        $users->select(
               '*'
        );

        $users->distinct('users.id');

        $users->orderByDesc('created_at');

        $users = $users->paginate($this->paginate);;


        return $users;
    }

    public function getSettings()
    {
        $targets = Target::select(['id', 'name'])->get();
        $interests = Interest::select(['id', 'name'])->get();
        $aperance_array = array();

        $userAuth = Auth::user();
        if ($userAuth != null) {
            $user = User::select(['id', 'name'])
                    ->where('id', $userAuth->id)->first();


            $selectedTargets = $user->target(['id', 'name'])->get();
            $targets_array = array();
            foreach ($selectedTargets as $item) {
                $targets_array[] = $item->id;
            }


            $selectedInteres = $user->interest(['id', 'name'])->get();
            $interest_array = array();
            foreach ($selectedInteres as $item) {
                $interest_array[] = $item->id;
            }

            //;jcnftv j,obt yfcnhjqrb
            $sechSettings = SearchSettings::select(
                    [
                            '*',
                    ]
            )->where('user_id', $user->id)->first();
        } else {
            if (isset($_COOKIE["searchSettings"])) {
                $cookie = $_COOKIE["searchSettings"];
            } else {
                $cookie = null;
            }

            if ($cookie != null) {
                $sechSettings = SearchSettings::select(
                        [
                                '*',
                        ]
                )
                        ->where('cookie', $cookie)->first();
            }
        }

        //��� �������� ������������� ���������.
        if (isset($sechSettings) && $sechSettings != null) {
            $interest_array_temp = $sechSettings->interest()->get();

            $interest_array = array();
            foreach ($interest_array_temp as $item) {
                $interest_array[] = $item->id;
            }


            $targets_array_temp = $sechSettings->target()->get();

            $targets_array = array();
            foreach ($targets_array_temp as $item) {
                $targets_array[] = $item->id;
            }
        }


        if (!isset($user)) {
            $user = null;
        }
        if (!isset($targets_array)) {
            $targets_array = array();
        }
        if (!isset($interest_array)) {
            $interest_array = array();
        }
        if (!isset($sechSettings)) {
            $sechSettings = array();
        }


        $seachSettingsArray = array();
        if (!empty($sechSettings)) {
            $seachSettingsArray['id'] = $sechSettings->id;
            $seachSettingsArray['meet'] = $sechSettings->meet;
            $seachSettingsArray['age_from'] = $sechSettings->age_from;
            $seachSettingsArray['age_to'] = $sechSettings->age_to;
            $seachSettingsArray['children'] = $sechSettings->children;
            $seachSettingsArray['relation'] = $sechSettings->relation_id;
        }

        $relations = Relation::select(['*'])->get();
        /*
        $children = Children::select(['*'])->get();
*/
        $rez_array = [
                "anket" => $user,
                "targets" => $targets,
                "selectedTargets" => $targets_array,
                "interests" => $interests,
                "selectedInterest" => $interest_array,
                "apperance" => null,
                "relations" => $relations,
             //   "children" => $children,
                "sechSettings" => $seachSettingsArray,
                "smoking" => null
        ];

        return $rez_array;
    }

}
