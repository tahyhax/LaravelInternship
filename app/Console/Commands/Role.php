<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Role as UserRole;
use Illuminate\Console\Command;

class Role extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'role:set
                            {email : user email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set user role by email';


    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $email = $this->argument('email');

        $user = User::query()->where('email', $email)->first();

        if (!$user) {
            $this->error('No user with this email');
            return 0;
        }

        $roles = UserRole::query()->get();

        $rolesName = $roles->pluck(['name'])->toArray();

        $choice = $this->choice('select role', $rolesName, 0, null, true);

        $rolesIds = $roles->whereIn('name', $choice)->pluck('id');

        if ($this->confirm("You really have update  user $email")) {
            if ($user->roles()->sync($rolesIds)) {

                $this->info('Roles have been updated');
            }
        }
    }
}
