<?php
namespace App\Console\Commands;

use App\Models\Customer;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CheckBirthdays extends Command
{
    protected $signature = 'check:birthdays';

    protected $description = 'Check customer birthdays and create notification entries';

    public function handle()
    {
        $today = Carbon::today();
        
        $customers = Customer::whereMonth('birth_date', $today->month)
            ->whereDay('birth_date', $today->day)
            ->get();
    
        foreach ($customers as $customer) {
            Notification::create([
                'customer_id' => $customer->id,
                'title'   => 'Birthday Notification',
                'message' => 'Today is ,' . $customer->first_name . '! birthaday send some offer him' 
            ]);
        }
    
        $this->info('Birthday notifications created successfully.');
    }
    
}