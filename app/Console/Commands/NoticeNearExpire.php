<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\School;
use Mail;
use App\Mail\NoticeNearExpire as NoticeNearExpireAccount;

class NoticeNearExpire extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'NoticeNearExpire:notice_near_expire_account';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'notice near expire account';

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
        $date = Carbon::now()->addDays(7)->format('Y-m-d');
        $schools = School::where('active_to',$date)->get();
        foreach($schools as $school){
            Mail::to($school->email)->send(new NoticeNearExpireAccount);
       }
    }
}
