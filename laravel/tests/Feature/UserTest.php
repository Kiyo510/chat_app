<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    protected $jsonUser = [
        'current_page',
        'data' => [
            '*' => [
                'id',
                'uuid',
                'name',
                'email',
                'email_verified_at',
                'created_at',
                'updated_at',
            ]
        ],
        'first_page_url',
        'from',
        'last_page',
        'last_page_url',
        'links' => [
            '*' =>
            [
                'url',
                'label',
                'active',
                'url',
                'label',
                'active',
                'url',
                'label',
                'active',
            ]
        ],
        'next_page_url',
        'path',
        'per_page',
        'prev_page_url',
        'to',
        'total'
    ];

    /**
     * ユーザー一覧
     * 
     * @covers \UserController
     * @return void
     */
    public function test_user_get_all()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        $response = $this->json('GET', '/api/users');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => $this->jsonUser,
        ]);

        $response->assertJsonFragment([
            'current_page' => 1,
            'id' => $user1->id,
            'name' => $user1->name,
            'email' => $user1->email,
        ]);

        $response->assertJsonFragment([
            'current_page' => 1,
            'id' => $user2->id,
            'name' => $user2->name,
            'email' => $user2->email,
        ]);
    }

    /**
     * ユーザー登録
     *
     * @covers \UserController
     * @return void
     */
    public function test_user_create()
    {
        $this->postJson('api/users', [
            'name' => 'user',
            'email' => 'user@example.com',
            'password' => 'Password123'
        ])
            ->assertStatus(200);
    }

    /**
     * ユーザー編集
     *
     * @covers \UserController
     * @return void
     */
    public function test_user_edit()
    {
        $user = User::factory()->create();
        $id = $user->id;

        $this->putJson("api/users/${id}", [
            'id' => $id,
            'name' => 'user_updated',
            'email' => 'user_updated@example.com',
            'password' => 'Password123Updated'
        ])
            ->assertStatus(200);

        //passwordはHash化処理が入るためチェックできなかった
        $this->assertDatabaseHas(
            'users',
            [
                'id' => $id,
                'name' => 'user_updated',
                'email' => 'user_updated@example.com',
            ]
        );
    }

    /**
     * ユーザー削除
     *
     * @covers \UserController
     * @return void
     */
    public function test_user_delete()
    {
        $user = User::factory()->create();
        $id = $user->id;

        $this->deleteJson("api/users/${id}");
        $this->assertDatabaseMissing('users', ['id' => $id]);
    }
}
