<?php

namespace Bytelaunch\Nutristudents\Tests\Feature;

use Bytelaunch\Nutristudents\Actions\Groups\AttachSiteAction;
use Bytelaunch\Nutristudents\Actions\Groups\DetachSiteAction;
use Bytelaunch\Nutristudents\Models\Group;
use Bytelaunch\Nutristudents\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;

class GroupTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }


    /**
     * @test
     */
    public function a_group_can_be_created(): void
    {
        $this->assertNotNull($this->group1->id);
    }

    /**
     * @test
     */
    public function a_site_can_be_attached_to_a_group(): void
    {

        $group = (new AttachSiteAction)
            ->setSite($this->site1)
            ->forGroup($this->group1)
            ->attach();

        $group = Group::find($this->group1->id);
        $this->assertTrue($group->sites()->where('sites.id', $this->site1->id)->exists());
    }

    /**
     * @test
     */
    public function a_site_can_be_detached_from_a_group(): void
    {
        $group = (new AttachSiteAction)
            ->setSite($this->site1)
            ->forGroup($this->group1)
            ->attach();

        $group = (new DetachSiteAction())
            ->setSite($this->site1)
            ->forGroup($this->group1)
            ->attach();

        $group = Group::find($this->group1->id);
        $this->assertFalse($group->sites()->where('sites.id', $this->site1->id)->exists());
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
    public function a_group_admin_can_edit_site(): void
    {

    }

    /**
     * @test
     */
    public function a_group_admin_can_edit_menu_for_site(): void
    {

    }

    /**
     * @test
     */
    public function a_group_admin_can_edit_order_for_site(): void
    {

    }

    /**
     * @test
     */
    public function a_group_admin_can_edit_student_count_for_site(): void
    {

    }

    /**
     * @test
     */
    public function a_group_admin_can_view_site(): void
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
