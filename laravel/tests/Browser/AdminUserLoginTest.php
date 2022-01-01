<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\AdminUser;
use Laravel\Dusk\Browser;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use Tests\DuskTestCase;

class AdminUserLoginTest extends DuskTestCase
{
    // use DatabaseMigrations;

    /**
     * 管理画面ログイン
     *
     * @return void
     */
    public function testAdminLogin()
    {
        // $user = AdminUser::factory()->create([
        //     'email' => 'test@dusk.com',
        //     'password' => bcrypt('test'),
        // ]);

        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/login')
                ->type('email', 'admin@example.com')
                ->type('password', 'Password11111')
                ->press('LOGIN')
                ->pause(5000)
                ->assertPathIs('/admin/dashboard');
        });
    }
}
