<?php

namespace Tests\Feature;

use App\Models\AdminUser;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

/**
 * @coversDefaultClass App\Traits\JsonRespondController
 */
class AdminUserTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    private $adminUser;

    /**
     * 管理者一覧
     * 
     * @covers App\Http\Controllers\Api\Admin\AdminUserController::index
     * @covers ::getHTTPStatusCode
     * @covers ::respond
     * @return void
     */
    public function test_admin_user_get_all()
    {
        $adminUser1 = AdminUser::factory()->create();
        $adminUser2 = AdminUser::factory()->create();

        $response = $this->json('GET', '/api/admins');
        $response
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    [
                        'id' => $adminUser1->id,
                        'name' => $adminUser1->name,
                        'email' => $adminUser1->email,
                    ],
                    [
                        'id' => $adminUser2->id,
                        'name' => $adminUser2->name,
                        'email' => $adminUser2->email,
                    ]
                ]
            ]);
    }

    /**
     * 管理者登録
     *
     * @covers App\Http\Controllers\Api\Admin\AdminUserController::store
     * @covers ::getHTTPStatusCode
     * @covers ::setHTTPStatusCode
     * @covers ::respondWithOK
     * @covers ::respond
     * @covers App\Rules\PasswordRule::passes
     * @return void
     */
    public function test_admin_user_create()
    {
        $this->postJson('api/admins', [
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => 'Password123'
        ])
            ->assertStatus(200);
    }

    /**
     * 管理者編集
     *
     * @covers App\Http\Controllers\Api\Admin\AdminUserController::update
     * @covers ::getHTTPStatusCode
     * @covers ::respond
     * @covers App\Rules\PasswordRule::passes
     * @return void
     */
    public function test_admin_user_edit()
    {
        $adminUser = AdminUser::factory()->create();
        $id = $adminUser->id;

        $this->putJson("api/admins/${id}", [
            'id' => $id,
            'name' => 'admin_updated',
            'email' => 'admin_updated@example.com',
            'password' => 'Password123Updated'
        ])
            ->assertStatus(200);

        //passwordはHash化処理が入るためチェックできなかった
        $this->assertDatabaseHas(
            'admin_users',
            [
                'id' => $id,
                'name' => 'admin_updated',
                'email' => 'admin_updated@example.com',
            ]
        );
    }

    /**
     * 管理者削除
     *
     * @covers App\Http\Controllers\Api\Admin\AdminUserController::destroy
     * @covers ::getHTTPStatusCode
     * @covers ::respondObjectDeleted
     * @covers ::respond
     * @return void
     */
    public function test_admin_user_delete()
    {
        $adminUser = AdminUser::factory()->create();
        $id = $adminUser->id;

        $this->deleteJson("api/admins/${id}");
        $this->assertDatabaseMissing('admin_users', ['id' => $id]);
    }
}
