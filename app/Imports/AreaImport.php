<?php

namespace App\Imports;

use App\Models\City;
use App\Models\State;
use App\Models\Country;
use App\Models\Area;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AreaImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        if (!isset($row['country_name']) || !isset($row['state_name']) || !isset($row['city_name']) || !isset($row['area_name'])) {
            return null;
        }

        $country = Country::where('name', trim($row['country_name']))->first();
        if (!$country) {
            return null;
        }

        $state = State::where('country_id', $country->id)
            ->where('name', trim($row['state_name']))
            ->first();

        if (!$state) {
            return null;
        }

        $city = City::where('state_id', $state->id)
            ->where('name', trim($row['city_name']))
            ->first();

        if (!$city) {
            return null;
        }

        $existingArea = Area::where('city_id', $city->id)
            ->where('name', trim($row['area_name']))
            ->first();

        if ($existingArea) {
            return null;
        }

        return new Area([
            'city_id'    => $city->id,
            'state_id'   => $state->id,
            'country_id' => $country->id,
            'name'       => trim($row['area_name']),
            'status'     => 1,
            'created_at' => now(),
        ]);
    }
}
