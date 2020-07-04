<?php

use Illuminate\Database\Seeder;

class AgendaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('agenda')->insert([
            [
                'visibilidade' => '1',
                'titulo' => 'Reuniao',
                'descricao' => 'Reuniao com cliente',
                'cor' => '#a84e32 ',
                'dataInicio' => '2020-04-02 21:30:00',
                'dataFim' => '2020-04-12 21:30:00',
                'idUser' => '1',
            ],
            [
                'visibilidade' => '1',
                'titulo' => 'Lista',
                'descricao' => 'Lista com cliente',
                'cor' => '#a84e32 ',
                'dataInicio' => '2020-04-03 21:30:00',
                'dataFim' => '2020-04-13 21:30:00',
                'idUser' => '1',
            ]
        ]);
    }
}
