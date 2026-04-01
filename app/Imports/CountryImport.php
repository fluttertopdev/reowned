<?php

namespace App\Imports;

use App\Models\Country;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CountryImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Check if country with the same name already exists
        $existingCountry = Country::where('name', $row['name'])->first();

        if ($existingCountry) {
            return null; // Skip insertion if already exists
        }

        return new Country([
            'name' => $row['name'],
            'status' => 1, // Default Active
            'created_at' => now()
        ]);
    }
}
