<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Carbon\Carbon;
use App\Models\Investment;
use App\Models\Investor;
use App\Models\Earning;


class AddProfit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:profits';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command run the cron job that adds profit to the investor\'s earnings';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $investments = Investment::where('status', 'running')->get();

        foreach($investments as $investment) {
            if (Carbon::create($investment->updated_at)->addDays($investment->package->duration)->format('l jS \of F Y') >= Carbon::now()) {
                $earning = round(($investment->amount * ($investment->package->roi/100))/$investment->package->duration, 2);
                $investor = Investor::find($investment->investor_id);
                $investor->earnings += $earning;
                $investor->wallet_balance += $earning;
                $investor->save();
    
                Earning::create([
                    'investment_id' => $investment->id,
                    'investor_id' => $investor->id,
                    'amount' => $earning,
                ]);
            } else {
                $investment->status = 'completed';
                $investment->save();
            }
            
        }
        
        return 0;
    }
}
