<?php
    /**
     * Created by PhpStorm.
     * User: triest
     * Date: 27.08.2020
     * Time: 23:21
     */

    namespace App\Service;


    use App\Models\City;
    use App\Models\Event;

    class EventService
    {

        public function g(City $city = null)
        {
            if ($city == null) {
                $city = City::getCurrentCity();
            }
            if ($city == null) {
                return null;
            }

            $events = Event::inMyCity($city);

            $partificator = null;
            $partifucationArray = array();
            foreach ($events as $item) {
                $partificator = $item->checkUserParticipation();
                if ($partificator != false) {
                    array_push($partifucationArray, $partificator);
                }
            }
            return $partifucationArray;
        }
    }
