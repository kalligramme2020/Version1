<?php

namespace App\Console\Commands;

use App\Mail\MailToTenant;
use App\Mail\NewUserAccount;
use App\Models\Location;
use App\Notifications\TenantEmailNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class TenantNotifyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenantNotify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $locations = Location::with('locataire', 'baillieur', 'bien')->get();
        $finBail_time = strtotime($locations->fin_bail);
        $mod_date = strtotime($locations->fin_bail."- 28 days"); //jour a paitir du quel la notification sera declacher j-j 30
        foreach ($locations as $local){

            if ($local->locataire->id === $local->locataire_id && $local->bien->id === $local->bien_id)
            {
                if ($finBail_time > time())
                {
                    if (date("Y-m-d",$mod_date))
                    {
                        Mail::to($local->locataire->email)->send( new MailToTenant($local));

                    }
                }
            }



        }
    }
}
