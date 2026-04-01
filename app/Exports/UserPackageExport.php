<?php

namespace App\Exports;

use App\Models\Userpackage;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UserPackageExport implements FromCollection, WithHeadings
{
    private $filters;

    public function __construct($filters = [])
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $query = Userpackage::with(['user', 'itemPackage', 'adPackage'])->orderBy('id','DESC')
            ->whereNull('deleted_at');

        // filter by name/email
        if (!empty($this->filters['name'])) {
            $search = $this->filters['name'];

            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%");
            });
        }

        return $query->get()->map(function ($row) {
            $packageName = $row->itemPackage->name 
                ?? $row->adPackage->name 
                ?? '--';

            $status = 'Expired';
            if (!$row->end_date || now()->lte($row->end_date)) {
                if ($row->is_active == 1) {
                    $status = 'Active';
                }
            }

            return [
                'user_name'   => $row->user->name ?? '--',
                'user_email'  => $row->user->email ?? '--',
                'package_name'=> $packageName,
                'start_date'  => $row->start_date,
                'end_date'    => $row->end_date ?? 'Unlimited',
                'total_limit' => $row->total_limit ?? 'Unlimited',
                'used_limit'  => $row->used_limit,
                'status'      => $status,
                'created_at'  => $row->created_at,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'User Name',
            'User Email',
            'Package Name',
            'Start Date',
            'End Date',
            'Total Limit',
            'Used Limit',
            'Status',
            'Created At'
        ];
    }
}