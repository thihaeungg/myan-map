<?php

namespace ThihaMorph\MyanMap\Trait;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use ThihaMorph\MyanMap\Eloquent\City;
use ThihaMorph\MyanMap\Eloquent\State;
use ThihaMorph\MyanMap\Eloquent\SelfAdminister;

trait DataTrait
{
    public function seedData()
    {

        $flagJson = __DIR__ . '/json/flag.json';
        //flag
        $stateJson = __DIR__ . '/json/state.json';
        //state
        $cityJson = __DIR__ . '/json/city.json';
        //city
        $townshipJson = __DIR__ . '/json/township.json';
        //city
        $selfadministerJson = __DIR__ . '/json/selfadminister.json';
        //self administer


        $getFlags = file_get_contents($flagJson);

        $getStates = file_get_contents($stateJson);

        $getCities = file_get_contents($cityJson);

        $getTownships = file_get_contents($townshipJson);

        $getSelfadministers = file_get_contents($selfadministerJson);

        $states = json_decode($getStates, true);

        $selfadministers = json_decode($getSelfadministers, true);

        $cities = json_decode($getCities, true);

        $flags = json_decode($getFlags, true);

        $townships = json_decode($getTownships, true);

        foreach($states as $state){
            $newState = State::create([
                "name_mm" => $state['name_mm'],
                "name_en" => $state['name_en'],
                "flag" => $flags[$state['flag']],
            ]);

            $syncCities = $newState->cities()->createMany($cities[$state['flag']]);

            $newState->capital_id = City::where('name_en', $state['capital'])->first()->id;
            $newState->update();
            $starting_city_array = ['yangon','mandalay', 'naypyitaw'];
            foreach($syncCities as $createdCity){
                $fixCityString = str_replace(' ', '', strtolower($city['name_en']));
                if(in_array($createdCity->name_en, $starting_city_array)){
                    $syncTownship = $createdCity->townships()->createMany($townships[$fixCityString]);
                }
            }


            if($state['name_en'] == 'Shan State' || $state['name_en'] == 'Sagaing Region'){
                if($state['name_en'] == 'Shan State'){
                    foreach($selfadministers['shan_selfadministers'] as $selfadminister){
                        $newSelfAdminister = SelfAdminister::create([
                            "name_mm" => $selfadminister['name_mm'],
                            "name_en" => $selfadminister['name_en'],
                            "flag" => $flags[$selfadminister['flag']],
                        ]);

                        $newState->self_administers()->attach([$newSelfAdminister->id]);

                        foreach($cities[$state['flag']] as $city){
                            if($city['self_administer'] == $selfadminister['flag']){
                                $updateCity = City::where('name_en', $city['name_en'])->update(['self_administer_id' => $newSelfAdminister->id]);
                            }
                            $newSelfAdminister->capital_id = City::where('name_en', $selfadminister['capital'])->first()->id;
                            $newSelfAdminister->update();
                        }
                    }

                } else {
                    $newSelfAdminister = SelfAdminister::create([
                        "name_mm" => $selfadministers['sagaing_selfadminister']['name_mm'],
                        "name_en" => $selfadministers['sagaing_selfadminister']['name_en'],
                        "flag" => $flags[$selfadministers['sagaing_selfadminister']['flag']]
                    ]);

                    $newState->self_administers()->attach([$newSelfAdminister->id]);

                    foreach($cities[$state['flag']] as $city){
                        if($city['self_administer'] == $selfadministers['sagaing_selfadminister']['flag']){
                            $updateCity = City::where('name_en', $city['name_en'])->update(['self_administer_id' => $newSelfAdminister->id]);
                        }
                    }

                    $newSelfAdminister->capital_id = City::where('name_en', $selfadministers['sagaing_selfadminister']['capital'])->first()->id;
                    $newSelfAdminister->update();
                }

            }
        }
    }
}
