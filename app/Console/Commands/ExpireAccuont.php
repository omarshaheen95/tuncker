<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use Carbon\Carbon;
use App\School;
use Mail;
use App\Mail\ExpiredSubscription;

class ExpireAccuont extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ExpireAccuont:expireAccounts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'disable expire accounts';

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
     * @return mixed
     */
    public function handle()
    {
        $schools = School::where('active_to',date('Y-m-d'))->get();
        foreach($schools as $school){
            $teachers = Teacher::where('school_id',$school->id)->get();
            foreach($teachers as $teacher){
                $teacher->update(['active' => 0]);
            }
            Mail::to($school->email)->send(new ExpiredSubscription);
        }
    }
}
