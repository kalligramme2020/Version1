<?php

namespace App\Console\Commands;

use App\Http\Controllers\Auth;
use App\Models\Location;
use App\Models\User;
use App\Notifications\UserEmailNotfy;
use Illuminate\Console\Command;

class NotifyUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'userNotify';

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
        $locations = Location::with('baillieur','locataire','bien')->get();

        foreach ($locations as $location){
            $locataire = $location->locataire->nom;
            $bien = $location->bien->name;
            $finBail_time = strtotime($location->fin_bail);

            $mod_date = strtotime($location->fin_bail."- 28 days"); //jour a paitir du quel la notification sera declacher j-j 30


            if( $finBail_time > time())
                if (date("Y-m-d",$mod_date) )
                $location->baillieur->notify (new UserEmailNotfy( $locataire , $bien));

        }

    }
}

