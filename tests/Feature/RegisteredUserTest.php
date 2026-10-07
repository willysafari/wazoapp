<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class RegisteredUserTest extends TestCase
{
    public function test_registration_form_renders_with_a_csrf_token(): void
    {
        $response = $this->get('/register');

        $response->assertOk()->assertSee('name="_token"', false);
    }

    public function test_staff_member_can_register_and_is_logged_in(): void
    {
        $this->createUsersTable();
        $this->addStaffEmail('staff@example.com');

        $response = $this->post('/register', [
            'name' => 'Test Staff',
            'email' => 'staff@example.com',
            'password' => 'secret-password',
            'password_confirmation' => 'secret-password',
        ]);

        $response->assertRedirect(route('ideas.index'));
        $response->assertSessionHas('success', 'Account created successfully');
        $this->assertDatabaseHas('users', [
            'name' => 'Test Staff',
            'email' => 'staff@example.com',
        ]);

        $user = User::query()->where('email', 'staff@example.com')->firstOrFail();

        $this->assertAuthenticatedAs($user);
        $this->assertTrue(Hash::check('secret-password', $user->password));
    }

    public function test_registration_rejects_mismatched_password_confirmation(): void
    {
        $this->createUsersTable();
        $this->addStaffEmail('staff@example.com');

        $response = $this->post('/register', [
            'name' => 'Test Staff',
            'email' => 'staff@example.com',
            'password' => 'secret-password',
            'password_confirmation' => 'different-password',
        ]);

        $response->assertInvalid(['password']);
        $this->assertDatabaseMissing('users', ['email' => 'staff@example.com']);
    }

    private function addStaffEmail(string $email): void
    {
        config([
            'database.connections.sqlsrv.driver' => 'sqlite',
            'database.connections.sqlsrv.database' => ':memory:',
        ]);

        DB::purge('sqlsrv');
        DB::connection('sqlsrv')->statement("ATTACH DATABASE ':memory:' AS dbo");
        Schema::connection('sqlsrv')->create('dbo.Staffs', function (Blueprint $table): void {
            $table->string('Email');
        });
        DB::connection('sqlsrv')->table('dbo.Staffs')->insert(['Email' => $email]);
    }

    private function createUsersTable(): void
    {
        Schema::create('users', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }
}
