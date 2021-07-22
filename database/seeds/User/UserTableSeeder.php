<?php

use App\Models\User\User;
use App\Models\Role\UserRole;
use App\Models\Tender\Tender;
use App\Models\Role\AdminRole;
use App\Models\Role\EditorRole;
use Illuminate\Database\Seeder;
use App\Models\Role\ManagerRole;
use App\Models\Role\OwnerQARole;
use App\Jobs\Tender\TenderCreate;
use App\Models\Role\CustomerRole;
use App\Models\Role\SuperUserRole;
use App\Models\Role\ContractorRole;
use App\Models\Role\SeniorAdminRole;
use App\Models\DiscountCard\DiscountCard;
use App\Models\UserLegalData\UserLegalData;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        factory(User::class)->states(
                SuperUserRole::class,
                'Pudge'
            )->create();

        factory(User::class)->states(
                SeniorAdminRole::class,
                'Sven'
            )->create();

        factory(User::class)->states(
                ContractorRole::class, 
                'Hondor'
            )->create();

        factory(User::class)->states(
                AdminRole::class,
                'Maks'
            )->create();

        factory(User::class)->states(
                CustomerRole::class,
                'Yura'
            )->create();

        collect([
            factory(User::class)->states(ContractorRole::class)
                ->create([
                    User::COLUMN_FIRST_NAME     => 'Yura',
                    User::COLUMN_LAST_NAME      => 'Contractor',
                    User::COLUMN_PHONE          => '380901002030',
                    User::COLUMN_EMAIL          => 'yura.contractor@gmail.com',
                ])
        ])->map(function($user) {
            $user->legalData()->updateOrCreate(
                [],
                [
                    UserLegalData::COLUMN_BILL => 'UA'.rand(1000, 9999).'529900000260000062'.rand(1000, 9999),
                    UserLegalData::COLUMN_MFO => rand(100000, 999999),
                    UserLegalData::COLUMN_EDRPOU_CODE => rand(10000000, 99999999),
                    UserLegalData::COLUMN_SERIAL_NUMBER => 'АГ № '.rand(10000, 99999).' від '.rand(10, 30).'.'.rand(10, 12).'.201'.rand(1, 9).' р',
                    UserLegalData::COLUMN_LEGAL_STATUS => "Фізична Особа-Підприємець",
                ]
            );
        });

//        collect([
//            factory(User::class)->states(CustomerRole::class)
//                ->create([
//                    User::COLUMN_FIRST_NAME     => 'Yura',
//                    User::COLUMN_LAST_NAME      => 'Customer',
//                    User::COLUMN_PHONE          => '380901002040',
//                    User::COLUMN_EMAIL          => 'yura.customer@gmail.com',
//                ])
//        ])->map(function($user) {
//            $tender = TenderCreate::dispatchNow(
//                [
//                    Tender::COLUMN_STARTED_AT => now()->subDay(rand(12, 15)),
//                    Tender::COLUMN_FINISHED_AT => now()->subDay(rand(2, 5))
//                ],
//                $user
//            );
//            $tender->discountCards()->save(
//                factory(DiscountCard::class)->create([
//                    DiscountCard::COLUMN_USER_ID => $user
//                ])
//            );
//        });

        factory(User::class)->states(
                OwnerQARole::class,
                'owner_1'
            )->create();

        factory(User::class)->states(
                OwnerQARole::class,
                'owner_2'
            )->create();

        factory(User::class)->states(
                OwnerQARole::class,
                'owner_3'
            )->create();

        factory(User::class)->states([ManagerRole::class])->create();

        factory(User::class)->states([EditorRole::class])->create();

        factory(User::class, 2)->states([UserRole::class])->create();

        factory(User::class, 15)->states([ContractorRole::class])
            ->create()
            ->map(function($user) {
                $user->legalData()->updateOrCreate(
                    [],
                    [
                        UserLegalData::COLUMN_BILL => 'UA'.rand(1000, 9999).'529900000260000062'.rand(1000, 9999),
                        UserLegalData::COLUMN_MFO => rand(100000, 999999),
                        UserLegalData::COLUMN_EDRPOU_CODE => rand(10000000, 99999999),
                        UserLegalData::COLUMN_SERIAL_NUMBER => 'АГ № '.rand(10000, 99999).' від '.rand(10, 30).'.'.rand(10, 12).'.201'.rand(1, 9).' р',
                        UserLegalData::COLUMN_LEGAL_STATUS => "Фізична Особа-Підприємець",
                    ]
                );
            });

//        factory(User::class, 5)->states([CustomerRole::class])
//            ->create()
//            ->map(function($user) {
//                $tender = TenderCreate::dispatchNow(
//                    [
//                        Tender::COLUMN_STARTED_AT => now()->subDay(rand(12, 15)),
//                        Tender::COLUMN_FINISHED_AT => now()->subDay(rand(2, 5))
//                    ],
//                    $user
//                );
//                $tender->discountCards()->save(
//                    factory(DiscountCard::class)->create([
//                        DiscountCard::COLUMN_USER_ID => $user
//                    ])
//                );
//            });

        factory(User::class, 15)->states([CustomerRole::class])->create();

    }
}
