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

             [
                'module' => 'Category',
                'route_name' => 'category',
                'permission_name' => 'List',
                'group' => 'category',
                'is_default' => 0
            ],
            [
                'module' => 'Category',
                'route_name' => 'add-category',
                'permission_name' => 'Add',
                'group' => 'category',
                'is_default' => 0
            ],

             [
                'module' => 'Category',
                'route_name' => 'update-category',
                'permission_name' => 'Update',
                'group' => 'category',
                'is_default' => 0
            ],

             [
                'module' => 'Category',
                'route_name' => 'category-status',
                'permission_name' => 'Status',
                'group' => 'category',
                'is_default' => 0
            ],

             [
                'module' => 'Category',
                'route_name' => 'delete-category',
                'permission_name' => 'Delete',
                'group' => 'category',
                'is_default' => 0
            ],


            

             [
                'module' => 'Category',
                'route_name' => 'view-category',
                'permission_name' => 'View',
                'group' => 'category',
                'is_default' => 0
            ],

            [
                'module' => 'Category',
                'route_name' => 'category-translation',
                'permission_name' => 'Translation',
                'group' => 'category',
                'is_default' => 0
            ],


            

            [
                'module' => 'Category',
                'route_name' => 'add-subcategory',
                'permission_name' => 'Addsucategory',
                'group' => 'category',
                'is_default' => 0
            ],

             [
                'module' => 'Tip',
                'route_name' => 'tip',
                'permission_name' => 'List',
                'group' => 'tip',
                'is_default' => 0
            ],

              [
                'module' => 'Tip',
                'route_name' => 'tip-add',
                'permission_name' => 'Add',
                'group' => 'tip',
                'is_default' => 0
            ],

              [
                'module' => 'Tip',
                'route_name' => 'update-tip',
                'permission_name' => 'Update',
                'group' => 'tip',
                'is_default' => 0
            ],
             [
                'module' => 'Tip',
                'route_name' => 'tip-status',
                'permission_name' => 'Status',
                'group' => 'tip',
                'is_default' => 0
            ],


            

            [
                'module' => 'Tip',
                'route_name' => 'delete',
                'permission_name' => 'Delete',
                'group' => 'tip',
                'is_default' => 0
            ],

             [
                'module' => 'Tip',
                'route_name' => 'tip-translation',
                'permission_name' => 'Translation',
                'group' => 'tip',
                'is_default' => 0
            ],

             [
                'module' => 'Advertisementpackage',
                'route_name' => 'advertisementpackage',
                'permission_name' => 'List',
                'group' => 'advertisementpackage',
                'is_default' => 0
            ],

            [
                'module' => 'Advertisementpackage',
                'route_name' => 'add-advertisementpackage',
                'permission_name' => 'Add',
                'group' => 'advertisementpackage',
                'is_default' => 0
            ],

             [
                'module' => 'Advertisementpackage',
                'route_name' => 'update-advertisementpackage',
                'permission_name' => 'Update',
                'group' => 'advertisementpackage',
                'is_default' => 0
            ],

             [
                'module' => 'Advertisementpackage',
                'route_name' => 'status',
                'permission_name' => 'Status',
                'group' => 'advertisementpackage',
                'is_default' => 0
            ],

            [
                'module' => 'Advertisementpackage',
                'route_name' => 'delete-advertisementpackage',
                'permission_name' => 'Delete',
                'group' => 'advertisementpackage',
                'is_default' => 0
            ],

            

             [
                'module' => 'Advertisementpackage',
                'route_name' => 'advertisementpackage-translation',
                'permission_name' => 'Translation',
                'group' => 'advertisementpackage',
                'is_default' => 0
            ],

            [
                'module' => 'Itempackage',
                'route_name' => 'itempackage',
                'permission_name' => 'List',
                'group' => 'itempackage',
                'is_default' => 0
            ],

             [
                'module' => 'Itempackage',
                'route_name' => 'add-itempackage',
                'permission_name' => 'Add',
                'group' => 'itempackage',
                'is_default' => 0
            ],

             [
                'module' => 'Itempackage',
                'route_name' => 'update-itempackage',
                'permission_name' => 'Update',
                'group' => 'itempackage',
                'is_default' => 0
            ],

             [
                'module' => 'Itempackage',
                'route_name' => 'status',
                'permission_name' => 'Status',
                'group' => 'itempackage',
                'is_default' => 0
            ],

             [
                'module' => 'Itempackage',
                'route_name' => 'delete-itempackage',
                'permission_name' => 'Delete',
                'group' => 'itempackage',
                'is_default' => 0
            ],

           

            [
                'module' => 'Itempackage',
                'route_name' => 'itempackage-translation',
                'permission_name' => 'Translation',
                'group' => 'itempackage',
                'is_default' => 0
            ],

              [
                'module' => 'Blog',
                'route_name' => 'blog',
                'permission_name' => 'List',
                'group' => 'blog',
                'is_default' => 0
            ],

             [
                'module' => 'Blog',
                'route_name' => 'add-blog',
                'permission_name' => 'Add',
                'group' => 'blog',
                'is_default' => 0
            ],


             [
                'module' => 'Blog',
                'route_name' => 'update-blog',
                'permission_name' => 'Update',
                'group' => 'blog',
                'is_default' => 0
            ],

             [
                'module' => 'Blog',
                'route_name' => 'status',
                'permission_name' => 'Status',
                'group' => 'blog',
                'is_default' => 0
            ],

             [
                'module' => 'Blog',
                'route_name' => 'delete-blog',
                'permission_name' => 'Delete',
                'group' => 'blog',
                'is_default' => 0
            ],

            [
                'module' => 'Blog',
                'route_name' => 'translation-blog',
                'permission_name' => 'Translation',
                'group' => 'blog',
                'is_default' => 0
            ],

            

             [
                'module' => 'Tag',
                'route_name' => 'tag',
                'permission_name' => 'List',
                'group' => 'tag',
                'is_default' => 0
            ],


             [
                'module' => 'Tag',
                'route_name' => 'add-tag',
                'permission_name' => 'Add',
                'group' => 'tag',
                'is_default' => 0
            ],

            [
                'module' => 'Tag',
                'route_name' => 'update-tag',
                'permission_name' => 'Update',
                'group' => 'tag',
                'is_default' => 0
            ],

             [
                'module' => 'Tag',
                'route_name' => 'status',
                'permission_name' => 'Status',
                'group' => 'tag',
                'is_default' => 0
            ],

            [
                'module' => 'Tag',
                'route_name' => 'delete-tag',
                'permission_name' => 'Delete',
                'group' => 'tag',
                'is_default' => 0
            ],

             [
                'module' => 'Tag',
                'route_name' => 'translation-tag',
                'permission_name' => 'Translation',
                'group' => 'tag',
                'is_default' => 0
            ],

             [
                'module' => 'Notification',
                'route_name' => 'notification',
                'permission_name' => 'List',
                'group' => 'notification',
                'is_default' => 0
            ],

             [
                'module' => 'Notification',
                'route_name' => 'add-notification',
                'permission_name' => 'Add',
                'group' => 'notification',
                'is_default' => 0
            ],

            [
                'module' => 'Notification',
                'route_name' => 'view-notification',
                'permission_name' => 'View',
                'group' => 'notification',
                'is_default' => 0
            ],

             [
                'module' => 'Notification',
                'route_name' => 'delete-notification',
                'permission_name' => 'Delete',
                'group' => 'notification',
                'is_default' => 0
            ],

             [
                'module' => 'Cms',
                'route_name' => 'cms',
                'permission_name' => 'List',
                'group' => 'cms',
                'is_default' => 0
            ],

            [
                'module' => 'Cms',
                'route_name' => 'add-cms',
                'permission_name' => 'Add',
                'group' => 'cms',
                'is_default' => 0
            ],

             [
                'module' => 'Cms',
                'route_name' => 'update-cms',
                'permission_name' => 'Update',
                'group' => 'cms',
                'is_default' => 0
            ],

            [
                'module' => 'Cms',
                'route_name' => 'status',
                'permission_name' => 'Status',
                'group' => 'cms',
                'is_default' => 0
            ],

            [
                'module' => 'Cms',
                'route_name' => 'delete-cms',
                'permission_name' => 'Delete',
                'group' => 'cms',
                'is_default' => 0
            ],

             
            
             [
                'module' => 'Cms',
                'route_name' => 'cms-translation',
                'permission_name' => 'Translation',
                'group' => 'cms',
                'is_default' => 0
            ],

              [
                'module' => 'Faq',
                'route_name' => 'faq',
                'permission_name' => 'List',
                'group' => 'faq',
                'is_default' => 0
            ],

              [
                'module' => 'Faq',
                'route_name' => 'add-faq',
                'permission_name' => 'Add',
                'group' => 'faq',
                'is_default' => 0
            ],

                 [
                'module' => 'Faq',
                'route_name' => 'update-faq',
                'permission_name' => 'Update',
                'group' => 'faq',
                'is_default' => 0
            ],

             [
                'module' => 'Faq',
                'route_name' => 'status',
                'permission_name' => 'Status',
                'group' => 'faq',
                'is_default' => 0
            ],

              [
                'module' => 'Faq',
                'route_name' => 'delete-faq',
                'permission_name' => 'Delete',
                'group' => 'faq',
                'is_default' => 0
            ],

            

            [
                'module' => 'Faq',
                'route_name' => 'faq-translation',
                'permission_name' => 'Translation',
                'group' => 'faq',
                'is_default' => 0
            ],

            

            [
                'module' => 'Slider',
                'route_name' => 'slider',
                'permission_name' => 'List',
                'group' => 'slider',
                'is_default' => 0
            ],

             [
                'module' => 'Slider',
                'route_name' => 'add-slider',
                'permission_name' => 'Add',
                'group' => 'slider',
                'is_default' => 0
            ],

             [
                'module' => 'Slider',
                'route_name' => 'update-slider',
                'permission_name' => 'Update',
                'group' => 'slider',
                'is_default' => 0
            ],
             
              [
                'module' => 'Slider',
                'route_name' => 'status',
                'permission_name' => 'Status',
                'group' => 'slider',
                'is_default' => 0
            ],

             [
                'module' => 'Slider',
                'route_name' => 'delete-slider',
                'permission_name' => 'Delete',
                'group' => 'slider',
                'is_default' => 0
            ],

           

            [
                'module' => 'Slider',
                'route_name' => 'translation',
                'permission_name' => 'Translation',
                'group' => 'slider',
                'is_default' => 0
            ],


             [
                'module' => 'Location',
                'route_name' => 'location',
                'permission_name' => 'List',
                'group' => 'location',
                'is_default' => 0
            ],

             [
                'module' => 'Language',
                'route_name' => 'language',
                'permission_name' => 'List',
                'group' => 'language',
                'is_default' => 0
            ],

             [
                'module' => 'Language',
                'route_name' => 'add-language',
                'permission_name' => 'Add',
                'group' => 'language',
                'is_default' => 0
            ],

             [
                'module' => 'Language',
                'route_name' => 'update-language',
                'permission_name' => 'Update',
                'group' => 'language',
                'is_default' => 0
            ],


             [
                'module' => 'Language',
                'route_name' => 'status',
                'permission_name' => 'Status',
                'group' => 'language',
                'is_default' => 0
            ],

            [
                'module' => 'Language',
                'route_name' => 'delete-language',
                'permission_name' => 'Delete',
                'group' => 'language',
                'is_default' => 0
            ],

            [
                'module' => 'Language',
                'route_name' => 'defult-language',
                'permission_name' => 'Defult',
                'group' => 'language',
                'is_default' => 0
            ],

             [
                'module' => 'Language',
                'route_name' => 'language-translation',
                'permission_name' => 'Translation',
                'group' => 'language',
                'is_default' => 0
            ],

            

             [
                'module' => 'Setting',
                'route_name' => 'setting',
                'permission_name' => 'List',
                'group' => 'setting',
                'is_default' => 0
            ],

             [
                'module' => 'Seosetting',
                'route_name' => 'seosetting',
                'permission_name' => 'List',
                'group' => 'seosetting',
                'is_default' => 0
            ],

            [
                'module' => 'Customer',
                'route_name' => 'customer',
                'permission_name' => 'List',
                'group' => 'customer',
                'is_default' => 0
            ],
            
             [
                'module' => 'Customer',
                'route_name' => 'customer-update',
                'permission_name' => 'Update',
                'group' => 'customer',
                'is_default' => 0
            ],
           
           [
                'module' => 'Customer',
                'route_name' => 'customer-status',
                'permission_name' => 'Status',
                'group' => 'customer',
                'is_default' => 0
            ],

             [
                'module' => 'Customer',
                'route_name' => 'delete-customer',
                'permission_name' => 'Delete',
                'group' => 'customer',
                'is_default' => 0
            ],

            [
                'module' => 'Customer',
                'route_name' => 'assign-packages',
                'permission_name' => 'Assign packages',
                'group' => 'customer',
                'is_default' => 0
            ],

             [
                'module' => 'Customer',
                'route_name' => 'view-packages',
                'permission_name' => 'View packages',
                'group' => 'customer',
                'is_default' => 0
            ],

             [
                'module' => 'Report reason',
                'route_name' => 'report-reason',
                'permission_name' => 'List',
                'group' => 'reportreason',
                'is_default' => 0
            ],

             [
                'module' => 'Report reason',
                'route_name' => 'add-report-reason',
                'permission_name' => 'Add',
                'group' => 'reportreason',
                'is_default' => 0
            ],

             [
                'module' => 'Report reason',
                'route_name' => 'report-reason-update',
                'permission_name' => 'Update',
                'group' => 'reportreason',
                'is_default' => 0
            ],

            [
                'module' => 'Report reason',
                'route_name' => 'report-reason-status',
                'permission_name' => 'Status',
                'group' => 'reportreason',
                'is_default' => 0
            ],

             [
                'module' => 'Report reason',
                'route_name' => 'report-reason-delete',
                'permission_name' => 'Delete',
                'group' => 'reportreason',
                'is_default' => 0
            ],


              [
                'module' => 'User Report',
                'route_name' => 'user-report',
                'permission_name' => 'List',
                'group' => 'userreport',
                'is_default' => 0
            ],

              [
                'module' => 'User Report',
                'route_name' => 'user-report-view',
                'permission_name' => 'View',
                'group' => 'userreport',
                'is_default' => 0
            ],

             [
                'module' => 'User Report',
                'route_name' => 'user-report-delete',
                'permission_name' => 'Delete',
                'group' => 'userreport',
                'is_default' => 0
            ],

             [
                'module' => 'Seller Verification',
                'route_name' => 'seller-verification',
                'permission_name' => 'List',
                'group' => 'sellerverification',
                'is_default' => 0
            ],
             
               [
                'module' => 'Seller Verification',
                'route_name' => 'seller-verification-status',
                'permission_name' => 'Status',
                'group' => 'sellerverification',
                'is_default' => 0
            ],
             [
                'module' => 'Seller Verification',
                'route_name' => 'seller-verification-delete',
                'permission_name' => 'Delete',
                'group' => 'sellerverification',
                'is_default' => 0
            ],

             [
                'module' => 'Seller Verification',
                'route_name' => 'seller-verification-view',
                'permission_name' => 'View',
                'group' => 'sellerverification',
                'is_default' => 0
            ],

             [
                'module' => 'Reviews',
                'route_name' => 'reviews',
                'permission_name' => 'List',
                'group' => 'reviews',
                'is_default' => 0
            ],

             [
                'module' => 'User Queries',
                'route_name' => 'user-queries',
                'permission_name' => 'List',
                'group' => 'userqueries',
                'is_default' => 0
            ],

             [
                'module' => 'User Queries',
                'route_name' => 'user-queries-view',
                'permission_name' => 'View',
                'group' => 'userqueries',
                'is_default' => 0
            ],


             [
                'module' => 'User Queries',
                'route_name' => 'user-queries-delete',
                'permission_name' => 'Delete',
                'group' => 'userqueries',
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
                    'created_at' => now() 
                ]);
            }
        }
    }
}
