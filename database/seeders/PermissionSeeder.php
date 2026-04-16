<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tempArr = [
            [
                'module' => 'Dashboard',
                'route_name' => 'dashboard',
                'permission_name' => 'Dashboard',
                'group' => 'dashboard',
                'is_default' => 1
            ],

            // Category routes
            [
                'module' => 'Category',
                'route_name' => 'category.index',
                'permission_name' => 'List',
                'group' => 'category',
                'is_default' => 0
            ],
            [
                'module' => 'Category',
                'route_name' => 'category.form',
                'permission_name' => 'Add',
                'group' => 'category',
                'is_default' => 0
            ],
            [
                'module' => 'Category',
                'route_name' => 'category.update',
                'permission_name' => 'Update',
                'group' => 'category',
                'is_default' => 0
            ],
            [
                'module' => 'Category',
                'route_name' => 'category.updateStatus',
                'permission_name' => 'Status',
                'group' => 'category',
                'is_default' => 0
            ],
            [
                'module' => 'Category',
                'route_name' => 'category.destroy',
                'permission_name' => 'Delete',
                'group' => 'category',
                'is_default' => 0
            ],
            [
                'module' => 'Category',
                'route_name' => 'category.translation',
                'permission_name' => 'Translation',
                'group' => 'category',
                'is_default' => 0
            ],
            [
                'module' => 'Category',
                'route_name' => 'category.updateFeatured',
                'permission_name' => 'Update Featured',
                'group' => 'category',
                'is_default' => 0
            ],

            // Tip routes
            [
                'module' => 'Tip',
                'route_name' => 'tips.index',
                'permission_name' => 'List',
                'group' => 'tip',
                'is_default' => 0
            ],
            [
                'module' => 'Tip',
                'route_name' => 'tips.create',
                'permission_name' => 'Add',
                'group' => 'tip',
                'is_default' => 0
            ],
            [
                'module' => 'Tip',
                'route_name' => 'tips.update',
                'permission_name' => 'Update',
                'group' => 'tip',
                'is_default' => 0
            ],
            [
                'module' => 'Tip',
                'route_name' => 'tips.updateStatus',
                'permission_name' => 'Status',
                'group' => 'tip',
                'is_default' => 0
            ],
            [
                'module' => 'Tip',
                'route_name' => 'tips.destroy',
                'permission_name' => 'Delete',
                'group' => 'tip',
                'is_default' => 0
            ],
            [
                'module' => 'Tip',
                'route_name' => 'tips.translation',
                'permission_name' => 'Translation',
                'group' => 'tip',
                'is_default' => 0
            ],

            // Item routes
            [
                'module' => 'Item',
                'route_name' => 'item.index',
                'permission_name' => 'List',
                'group' => 'item',
                'is_default' => 0
            ],
            [
                'module' => 'Item',
                'route_name' => 'item.updateStatus',
                'permission_name' => 'Status',
                'group' => 'item',
                'is_default' => 0
            ],

            // Customer routes
            [
                'module' => 'Customer',
                'route_name' => 'customer.index',
                'permission_name' => 'List',
                'group' => 'customer',
                'is_default' => 0
            ],
            [
                'module' => 'Customer',
                'route_name' => 'customer.update',
                'permission_name' => 'Update',
                'group' => 'customer',
                'is_default' => 0
            ],
            [
                'module' => 'Customer',
                'route_name' => 'customer.updateStatus',
                'permission_name' => 'Status',
                'group' => 'customer',
                'is_default' => 0
            ],
            [
                'module' => 'Customer',
                'route_name' => 'customer.destroy',
                'permission_name' => 'Delete',
                'group' => 'customer',
                'is_default' => 0
            ],
            [
                'module' => 'Customer',
                'route_name' => 'customer.assignpackage',
                'permission_name' => 'Assign packages',
                'group' => 'customer',
                'is_default' => 0
            ],
            [
                'module' => 'Customer',
                'route_name' => 'customer.adspackage',
                'permission_name' => 'View packages',
                'group' => 'customer',
                'is_default' => 0
            ],

            // Contact Us routes
            [
                'module' => 'Contact Us',
                'route_name' => 'contact_us.index',
                'permission_name' => 'List',
                'group' => 'contact_us',
                'is_default' => 0
            ],
            [
                'module' => 'Contact Us',
                'route_name' => 'contact_us.reply',
                'permission_name' => 'Reply',
                'group' => 'contact_us',
                'is_default' => 0
            ],

            // Seller routes (Verification)
            [
                'module' => 'Seller Verification',
                'route_name' => 'seller.index',
                'permission_name' => 'List',
                'group' => 'sellerverification',
                'is_default' => 0
            ],
            [
                'module' => 'Seller Verification',
                'route_name' => 'seller.updateStatus',
                'permission_name' => 'Status',
                'group' => 'sellerverification',
                'is_default' => 0
            ],
            [
                'module' => 'Seller Verification',
                'route_name' => 'seller.update',
                'permission_name' => 'Update',
                'group' => 'sellerverification',
                'is_default' => 0
            ],
            [
                'module' => 'Seller Verification',
                'route_name' => 'seller.destroy',
                'permission_name' => 'Delete',
                'group' => 'sellerverification',
                'is_default' => 0
            ],
            [
                'module' => 'Seller Verification',
                'route_name' => 'seller.form',
                'permission_name' => 'View',
                'group' => 'sellerverification',
                'is_default' => 0
            ],

            // Advertisement Package routes
            [
                'module' => 'Advertisement Package',
                'route_name' => 'advertisement-package.index',
                'permission_name' => 'List',
                'group' => 'advertisementpackage',
                'is_default' => 0
            ],
            [
                'module' => 'Advertisement Package',
                'route_name' => 'advertisement-package.form',
                'permission_name' => 'Add',
                'group' => 'advertisementpackage',
                'is_default' => 0
            ],
            [
                'module' => 'Advertisement Package',
                'route_name' => 'advertisement-package.update',
                'permission_name' => 'Update',
                'group' => 'advertisementpackage',
                'is_default' => 0
            ],
            [
                'module' => 'Advertisement Package',
                'route_name' => 'advertisement-package.updateStatus',
                'permission_name' => 'Status',
                'group' => 'advertisementpackage',
                'is_default' => 0
            ],
            [
                'module' => 'Advertisement Package',
                'route_name' => 'advertisement-package.destroy',
                'permission_name' => 'Delete',
                'group' => 'advertisementpackage',
                'is_default' => 0
            ],
            [
                'module' => 'Advertisement Package',
                'route_name' => 'advertisement-package.translation',
                'permission_name' => 'Translation',
                'group' => 'advertisementpackage',
                'is_default' => 0
            ],

            // Item Package routes
            [
                'module' => 'Item Package',
                'route_name' => 'item-listing-package.index',
                'permission_name' => 'List',
                'group' => 'itempackage',
                'is_default' => 0
            ],
            [
                'module' => 'Item Package',
                'route_name' => 'item-listing-package.form',
                'permission_name' => 'Add',
                'group' => 'itempackage',
                'is_default' => 0
            ],
            [
                'module' => 'Item Package',
                'route_name' => 'item-listing-package.update',
                'permission_name' => 'Update',
                'group' => 'itempackage',
                'is_default' => 0
            ],
            [
                'module' => 'Item Package',
                'route_name' => 'item-listing-package.updateStatus',
                'permission_name' => 'Status',
                'group' => 'itempackage',
                'is_default' => 0
            ],
            [
                'module' => 'Item Package',
                'route_name' => 'item-listing-package.destroy',
                'permission_name' => 'Delete',
                'group' => 'itempackage',
                'is_default' => 0
            ],
            [
                'module' => 'Item Package',
                'route_name' => 'item-listing-package.translation',
                'permission_name' => 'Translation',
                'group' => 'itempackage',
                'is_default' => 0
            ],

            // User Package / Transactions routes
            [
                'module' => 'User Package',
                'route_name' => 'userpackage.index',
                'permission_name' => 'List',
                'group' => 'transactions',
                'is_default' => 0
            ],
            [
                'module' => 'Transactions',
                'route_name' => 'transactions.index',
                'permission_name' => 'List',
                'group' => 'transactions',
                'is_default' => 0
            ],

            // Report Reason routes
            [
                'module' => 'Report reason',
                'route_name' => 'reportreason.index',
                'permission_name' => 'List',
                'group' => 'reportreason',
                'is_default' => 0
            ],
            [
                'module' => 'Report reason',
                'route_name' => 'reportreason.form',
                'permission_name' => 'Add',
                'group' => 'reportreason',
                'is_default' => 0
            ],
            [
                'module' => 'Report reason',
                'route_name' => 'reportreason.update',
                'permission_name' => 'Update',
                'group' => 'reportreason',
                'is_default' => 0
            ],
            [
                'module' => 'Report reason',
                'route_name' => 'reportreason.updateStatus',
                'permission_name' => 'Status',
                'group' => 'reportreason',
                'is_default' => 0
            ],
            [
                'module' => 'Report reason',
                'route_name' => 'reportreason.destroy',
                'permission_name' => 'Delete',
                'group' => 'reportreason',
                'is_default' => 0
            ],

            // User Report routes
            [
                'module' => 'User Report',
                'route_name' => 'userreport.index',
                'permission_name' => 'List',
                'group' => 'userreport',
                'is_default' => 0
            ],
            [
                'module' => 'User Report',
                'route_name' => 'userreport.form',
                'permission_name' => 'View',
                'group' => 'userreport',
                'is_default' => 0
            ],

            // Role routes
            ['module' => 'Role', 'route_name' => 'role.index', 'permission_name' => 'List', 'group' => 'role', 'is_default' => 0],
            ['module' => 'Role', 'route_name' => 'role.store', 'permission_name' => 'Add', 'group' => 'role', 'is_default' => 0],
            ['module' => 'Role', 'route_name' => 'role.update', 'permission_name' => 'Update', 'group' => 'role', 'is_default' => 0],
            ['module' => 'Role', 'route_name' => 'role.destroy', 'permission_name' => 'Delete', 'group' => 'role', 'is_default' => 0],

            // Staff routes
            ['module' => 'Staff', 'route_name' => 'staff.index', 'permission_name' => 'List', 'group' => 'staff', 'is_default' => 0],
            ['module' => 'Staff', 'route_name' => 'staff.form', 'permission_name' => 'Add', 'group' => 'staff', 'is_default' => 0],
            ['module' => 'Staff', 'route_name' => 'staff.update', 'permission_name' => 'Update', 'group' => 'staff', 'is_default' => 0],
            ['module' => 'Staff', 'route_name' => 'staff.updateStatus', 'permission_name' => 'Status Change', 'group' => 'staff', 'is_default' => 0],
            ['module' => 'Staff', 'route_name' => 'staff.destroy', 'permission_name' => 'Delete', 'group' => 'staff', 'is_default' => 0],

            // Banner routes
            [
                'module' => 'Banner',
                'route_name' => 'banner.edit',
                'permission_name' => 'Edit',
                'group' => 'banner',
                'is_default' => 0
            ],

            // CMS routes
            [
                'module' => 'Cms',
                'route_name' => 'cms.index',
                'permission_name' => 'List',
                'group' => 'cms',
                'is_default' => 0
            ],
            [
                'module' => 'Cms',
                'route_name' => 'cms.create',
                'permission_name' => 'Add',
                'group' => 'cms',
                'is_default' => 0
            ],
            [
                'module' => 'Cms',
                'route_name' => 'cms.update',
                'permission_name' => 'Update',
                'group' => 'cms',
                'is_default' => 0
            ],
            [
                'module' => 'Cms',
                'route_name' => 'cms.updateStatus',
                'permission_name' => 'Status',
                'group' => 'cms',
                'is_default' => 0
            ],
            [
                'module' => 'Cms',
                'route_name' => 'cms.destroy',
                'permission_name' => 'Delete',
                'group' => 'cms',
                'is_default' => 0
            ],
            [
                'module' => 'Cms',
                'route_name' => 'cms.translation',
                'permission_name' => 'Translation',
                'group' => 'cms',
                'is_default' => 0
            ],

            // FAQ routes
            [
                'module' => 'Faq',
                'route_name' => 'faq.index',
                'permission_name' => 'List',
                'group' => 'faq',
                'is_default' => 0
            ],
            [
                'module' => 'Faq',
                'route_name' => 'faq.create',
                'permission_name' => 'Add',
                'group' => 'faq',
                'is_default' => 0
            ],
            [
                'module' => 'Faq',
                'route_name' => 'faq.update',
                'permission_name' => 'Update',
                'group' => 'faq',
                'is_default' => 0
            ],
            [
                'module' => 'Faq',
                'route_name' => 'faq.updateStatus',
                'permission_name' => 'Status',
                'group' => 'faq',
                'is_default' => 0
            ],
            [
                'module' => 'Faq',
                'route_name' => 'faq.destroy',
                'permission_name' => 'Delete',
                'group' => 'faq',
                'is_default' => 0
            ],
            [
                'module' => 'Faq',
                'route_name' => 'faq.translation',
                'permission_name' => 'Translation',
                'group' => 'faq',
                'is_default' => 0
            ],

            // Language routes
            [
                'module' => 'Language',
                'route_name' => 'language.index',
                'permission_name' => 'List',
                'group' => 'language',
                'is_default' => 0
            ],
            [
                'module' => 'Language',
                'route_name' => 'language.form',
                'permission_name' => 'Add',
                'group' => 'language',
                'is_default' => 0
            ],
            [
                'module' => 'Language',
                'route_name' => 'language.update',
                'permission_name' => 'Update',
                'group' => 'language',
                'is_default' => 0
            ],
            [
                'module' => 'Language',
                'route_name' => 'language.updateStatus',
                'permission_name' => 'Status',
                'group' => 'language',
                'is_default' => 0
            ],
            [
                'module' => 'Language',
                'route_name' => 'language.destroy',
                'permission_name' => 'Delete',
                'group' => 'language',
                'is_default' => 0
            ],

            // Setting routes
            [
                'module' => 'Setting',
                'route_name' => 'setting.index',
                'permission_name' => 'List',
                'group' => 'setting',
                'is_default' => 0
            ],
            [
                'module' => 'Setting',
                'route_name' => 'setting.update',
                'permission_name' => 'Update',
                'group' => 'setting',
                'is_default' => 0
            ],
        ];

        foreach ($tempArr as $key => $value) {
            $check = Permission::where('name', $value['route_name'])
                ->where('module', $value['module'])
                ->first();

            if (!$check) {
                Permission::insert([
                    'module' => $value['module'],
                    'name' => $value['route_name'],
                    'permission_name' => $value['permission_name'],
                    'group' => $value['group'],
                    'is_default' => $value['is_default'],
                    'created_at' => now(),
                    'guard_name' => 'admin'
                ]);
            }
        }
    }
}
