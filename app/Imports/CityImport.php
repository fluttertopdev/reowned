<?php

namespace App\Imports;

use App\Models\City;
use App\Models\State;
use App\Models\Country;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CityImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Validate required columns
        if (!isset($row['country_name']) || !isset($row['state_name']) || !isset($row['city_name']) || !isset($row['latitude']) || !isset($row['longitude'])) {
            return null;
        }

        // Find country
        $country = Country::where('name', trim($row['country_name']))->first();
        if (!$country) {
            return null; // Skip if country is not found
        }

        // Find state linked to country
        $state = State::where('country_id', $country->id)
            ->where('name', trim($row['state_name']))
            ->first();

        if (!$state) {
            return null; // Skip if state is not found
        }

        // Check if city already exists in the state
        $existingCity = City::where('state_id', $state->id)
            ->where('name', trim($row['city_name']))
            ->first();

        if ($existingCity) {
            return null; // Skip duplicate cities
        }

        // Insert new city with latitude & longitude
        return new City([
            'state_id'   => $state->id,
            'country_id' => $country->id,
            'name'       => trim($row['city_name']),
            'latitude'   => trim($row['latitude']),
            'longitude'  => trim($row['longitude']),
            'status'     => 1, // Default active
            'created_at' => now(),
        ]);
    }
}
