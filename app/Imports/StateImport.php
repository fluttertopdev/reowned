<?php

namespace App\Imports;

use App\Models\State;
use App\Models\Country;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StateImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {

        if (!isset($row['country_name']) || !isset($row['state_name'])) {
            return null;
        }


        $country = Country::where('name', trim($row['country_name']))->first();

        if (!$country) {
            return null;
        }


        $existingState = State::where('country_id', $country->id)
            ->where('name', trim($row['state_name']))
            ->first();

        if ($existingState) {
            return null; // Skip duplicate states
        }

        return new State([
            'country_id' => $country->id,
            'name'       => trim($row['state_name']),
            'status'     => 1,
            'created_at' => now(),
        ]);
    }
}
