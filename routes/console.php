<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command('clear:commonids', function () {
    do{
    $count = DB::table('profile_user')->whereColumn('user_id','profile_id')->count();
    DB::table('profile_user')->whereColumn('user_id','profile_id')->delete();
    factory(\App\ProfileUser::class,$count)->create();
    $this->info($count.'Records');
    }while ($count >0);

})->describe('clearing the same profile id and user id');

Artisan::command('clear:repeated', function () {
    do{
      $count= count( collect(\App\ProfileUser::all('user_id','profile_id'))->duplicates());
        $userids=collect(\App\ProfileUser::all('user_id','profile_id'))->duplicates()->pluck('user_id')->toArray();
        $profids=collect(\App\ProfileUser::all('user_id','profile_id'))->duplicates()->pluck('profile_id')->toArray();

        for($i=0;$i<count($profids)/2;$i++){
            $user=DB::table('profile_user')->where('user_id',$userids[$i])->where('profile_id',$profids[$i]);
            $user->delete();
        }
        factory(\App\ProfileUser::class,$count)->create();
        $this->info($count.'Records');
    }while($count>0);


})->describe('clearing the same profile id and user id');
