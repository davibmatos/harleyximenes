<?php

namespace App\Console\Commands;

use App\Models\Prazo;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UpdatePrazoStatus extends Command
{    
    protected $signature = 'app:update-prazo-status';    
    protected $description = 'Command description';
    public function handle()
{
    $today = Carbon::today();   
   
    $prazos = Prazo::where('data_fim', '<', $today)
                  ->where('status', 'em aberto')
                  ->get();
    
    foreach ($prazos as $prazo) {
        $prazo->status = 'vencido';
        $prazo->save();
    }
    
    $this->info('Status dos prazos atualizados com sucesso.');
}

}
