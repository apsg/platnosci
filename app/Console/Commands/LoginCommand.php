<?php
namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Crypt;

class LoginCommand extends Command
{
    protected $signature = 'login {user?}';

    protected $description = 'Login as a user';

    public function handle()
    {
        $userId = $this->argument('user') ?? $this->ask('Enter user ID');

        $user = User::find($userId);

        $data = [
            'id'       => $user->id,
            'valid_to' => Carbon::now()->addMinutes(5)->timestamp,
        ];

        $encryptedData = Crypt::encrypt($data);

        $url = route('admin.login', ['data' => $encryptedData]);

        $this->info($url);
    }
}
