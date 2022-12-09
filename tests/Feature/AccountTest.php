<?php

namespace Bytelaunch\Nutristudents\Tests\Feature;

use Bytelaunch\Nutristudents\Actions\Accounts\CreateUserAccountAction;
use Bytelaunch\Nutristudents\Actions\Accounts\UpdateUserAccountAction;
use Bytelaunch\Nutristudents\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AccountTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }


    /**
     * @test
     */
    public function a_user_account_can_be_created(): void
    {

        $this->assertNotNull($this->user1->id);
    }

    /**
     * @test
     */
    public function a_user_can_login(): void
    {
        $user = $this->user1;
        $this->actingAs($user);
        $this->assertAuthenticatedAs($user, $guard = null);
    }

    /**
     * @test
     */
    public function a_user_can_logout(): void
    {
        $this->assertGuest($guard = null);
    }

    /**
     * @test
     */
    public function a_user_can_be_edited(): void
    {
        $user = (new UpdateUserAccountAction)
                ->setUser($this->user1)
                ->setFirstName('test')
                ->update();
        $this->assertEquals($user->first_name , 'test');
    }


    /**
     * @test
     */
    public function a_user_can_attach_a_site_permission(): void
    {

    }

    /**
     * @test
     */
    public function a_user_can_attach_a_group_permission(): void
    {

    }

    /**
     * @test
     */
    public function a_permission_can_be_admin(): void
    {

    }

    /**
     * @test
     */
    public function a_permission_can_be_menu_edit(): void
    {

    }

    /**
     * @test
     */
    public function a_permission_can_be_order_edit(): void
    {

    }

    /**
     * @test
     */
    public function a_permission_can_be_student_count(): void
    {

    }

    /**
     * @test
     */
    public function a_permission_can_be_view(): void
    {

    }


    /**
     * @test
     */
    public function an_admin_can_edit_site(): void
    {

    }

    /**
     * @test
     */
    public function an_admin_can_edit_menu_for_site(): void
    {

    }

    /**
     * @test
     */
    public function an_admin_can_edit_order_for_site(): void
    {

    }

    /**
     * @test
     */
    public function an_admin_can_edit_student_count_for_site(): void
    {

    }

    /**
     * @test
     */
    public function an_admin_can_view_site(): void
    {

    }

    /**
     * @test
     */
    public function a_permissionless_user_cant_edit_site(): void
    {

    }

    /**
     * @test
     */
    public function a_permissionless_user_cant_menu_edit(): void
    {

    }

    /**
     * @test
     */
    public function a_permissionless_user_cant_edit_student_counts(): void
    {

    }

    /**
     * @test
     */
    public function a_permissionless_user_cant_view_site(): void
    {

    }
}
