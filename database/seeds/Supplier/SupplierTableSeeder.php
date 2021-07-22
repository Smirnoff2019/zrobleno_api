<?php

use Illuminate\Database\Seeder;
use App\Models\Supplier\Supplier;
use App\Models\SupplierCategory\SupplierCategory;
use App\Models\SupplierDiscount\CustomerSupplierDiscount;
use App\Models\SupplierDiscount\ContractorSupplierDiscount;

class SupplierTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        collect([
            factory(SupplierCategory::class)
                ->create([
                    SupplierCategory::COLUMN_NAME => 'Двері',
                    SupplierCategory::COLUMN_SLUG => 'doors',
                ]),
            factory(SupplierCategory::class)
                ->create([
                    SupplierCategory::COLUMN_NAME => 'Плитка',
                    SupplierCategory::COLUMN_SLUG => 'tile',
                ]),
            factory(SupplierCategory::class)
                ->create([
                    SupplierCategory::COLUMN_NAME => 'Вікна',
                    SupplierCategory::COLUMN_SLUG => 'window',
                ]),
            factory(SupplierCategory::class)
                ->create([
                    SupplierCategory::COLUMN_NAME => 'Сантехніка',
                    SupplierCategory::COLUMN_SLUG => 'plumbing',
                ]),
            factory(SupplierCategory::class)
                ->create([
                    SupplierCategory::COLUMN_NAME => 'Шпалера',
                    SupplierCategory::COLUMN_SLUG => 'trellis',
                ]),
            factory(SupplierCategory::class)
                ->create([
                    SupplierCategory::COLUMN_NAME => 'Меблі',
                    SupplierCategory::COLUMN_SLUG => 'furniture',
                ]),
        ])
            ->map(function($category) {

                $category->suppliers()
                    ->saveMany(
                        factory(Supplier::class, rand(4, 15))
                            ->create()
                            ->map(function($supplier) {

                                $supplier->customersDiscount()
                                    ->save(
                                        factory(ContractorSupplierDiscount::class)
                                        ->create([CustomerSupplierDiscount::COLUMN_VALUE => rand(10, 25)])
                                    );
                                $supplier->contractorsDiscount()
                                    ->save(
                                        factory(CustomerSupplierDiscount::class)
                                        ->create([CustomerSupplierDiscount::COLUMN_VALUE => rand(15, 45)])
                                    );

                                return $supplier;
                            })
                    );

            });

    //     factory(SupplierCategory::class)
    //         ->create([
    //             SupplierCategory::COLUMN_NAME => 'Двері',
    //             SupplierCategory::COLUMN_SLUG => 'doors',
    //         ])
    //         ->suppliers()
    //         ->saveMany(
    //             factory(Supplier::class, 9)->create()
    //                 ->map(function($supplier) {
    //                     $supplier->customersDiscount()
    //                         ->save(
    //                             factory(ContractorSupplierDiscount::class)
    //                             ->create([CustomerSupplierDiscount::COLUMN_VALUE => rand(10, 25)])
    //                         );
    //                     $supplier->contractorsDiscount()
    //                         ->save(
    //                             factory(CustomerSupplierDiscount::class)
    //                                 ->create([CustomerSupplierDiscount::COLUMN_VALUE => rand(15, 40)])
    //                         );
    //                     return $supplier;
    //                 })
    //         );

    //     factory(SupplierCategory::class)
    //         ->create([
    //             SupplierCategory::COLUMN_NAME => 'Плитка',
    //             SupplierCategory::COLUMN_SLUG => 'tile',
    //         ])
    //         ->suppliers()
    //         ->saveMany(
    //             factory(Supplier::class, 11)->create()
    //                 ->map(function($supplier) {
    //                     $supplier->customersDiscount()
    //                         ->save(factory(ContractorSupplierDiscount::class)->create());
    //                     $supplier->contractorsDiscount()
    //                         ->save(factory(CustomerSupplierDiscount::class)->create());
    //                     return $supplier;
    //                 })
    //         );

    //     factory(SupplierCategory::class)
    //         ->create([
    //             SupplierCategory::COLUMN_NAME => 'Вікна',
    //             SupplierCategory::COLUMN_SLUG => 'window',
    //         ])
    //         ->suppliers()
    //         ->saveMany(
    //             factory(Supplier::class, 7)->create()
    //                 ->map(function($supplier) {
    //                     $supplier->customersDiscount()
    //                         ->save(factory(ContractorSupplierDiscount::class)->create());
    //                     $supplier->contractorsDiscount()
    //                         ->save(factory(CustomerSupplierDiscount::class)->create());
    //                     return $supplier;
    //                 })
    //         );

    //     factory(SupplierCategory::class)
    //         ->create([
    //             SupplierCategory::COLUMN_NAME => 'Сантехніка',
    //             SupplierCategory::COLUMN_SLUG => 'plumbing',
    //         ])
    //         ->suppliers()
    //         ->saveMany(
    //             factory(Supplier::class, 5)->create()
    //                 ->map(function($supplier) {
    //                     $supplier->customersDiscount()
    //                         ->save(factory(ContractorSupplierDiscount::class)->create());
    //                     $supplier->contractorsDiscount()
    //                         ->save(factory(CustomerSupplierDiscount::class)->create());
    //                     return $supplier;
    //                 })
    //         );

    //     factory(SupplierCategory::class)
    //         ->create([
    //             SupplierCategory::COLUMN_NAME => 'Шпалера',
    //             SupplierCategory::COLUMN_SLUG => 'trellis',
    //         ])
    //         ->suppliers()
    //         ->saveMany(
    //             factory(Supplier::class, 18)->create()
    //                 ->map(function($supplier) {
    //                     $supplier->customersDiscount()
    //                         ->save(factory(ContractorSupplierDiscount::class)->create());
    //                     $supplier->contractorsDiscount()
    //                         ->save(factory(CustomerSupplierDiscount::class)->create());
    //                     return $supplier;
    //                 })
    //         );

    //     factory(SupplierCategory::class)
    //         ->create([
    //             SupplierCategory::COLUMN_NAME => 'Меблі',
    //             SupplierCategory::COLUMN_SLUG => 'furniture',
    //         ])
    //         ->suppliers()
    //         ->saveMany(
    //             factory(Supplier::class, 12)->create()
    //                 ->map(function($supplier) {
    //                     $supplier->customersDiscount()
    //                         ->save(factory(ContractorSupplierDiscount::class)->create());
    //                     $supplier->contractorsDiscount()
    //                         ->save(factory(CustomerSupplierDiscount::class)->create());
    //                     return $supplier;
    //                 })
    //         );
        
    }
    
}
