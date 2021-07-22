<?php

use App\Models\CalculatorOption\CalculatorOption;
use App\Models\CalculatorOption\Coefficient;
use Illuminate\Database\Seeder;

class CalculatorOptionTableSeeder extends Seeder
{
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        factory(CalculatorOption::class)
            ->states(Coefficient::class)
            ->create([
                Coefficient::COLUMN_NAME            => 'Коефіцієнт на область', 
                Coefficient::COLUMN_DESCRIPTION     => 'Коефіцієнт на область прив\'язується до значень Вартість підготовчих і чорнових робіт.
                За 1 беремо столицю', 
                Coefficient::COLUMN_SLUG            => 'per_region', 
                Coefficient::COLUMN_VALUE           => 1, 
            ]);
        
        factory(CalculatorOption::class)
            ->states(Coefficient::class)
            ->create([
                Coefficient::COLUMN_NAME            => 'Коефіцієнт на вторинний ринок', 
                Coefficient::COLUMN_DESCRIPTION     => 'Коефіцієнт на вторинний ринок прив\'язується до значень  Вартість підготовчих і чорнових робіт.', 
                Coefficient::COLUMN_SLUG            => 'secondary_market', 
                Coefficient::COLUMN_VALUE           => 1.2, 
            ]);
        
        factory(CalculatorOption::class)
            ->states(Coefficient::class)
            ->create([
                Coefficient::COLUMN_NAME            => 'Коефіцієнт висоти стелі: більше 3-х м.', 
                Coefficient::COLUMN_DESCRIPTION     => 'Коеф. на висоту стелі прив\'язується до значень всіх робіт, тобто вартість робіт кожної кімнати множиться на коеф при виборі в інфо. висоти більше 3-х м.', 
                Coefficient::COLUMN_SLUG            => 'ceiling_height', 
                Coefficient::COLUMN_VALUE           => 1.08, 
            ]);

    }

}
