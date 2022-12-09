<?php

namespace Bytelaunch\Nutristudents\Tests\Feature;

use Bytelaunch\Nutristudents\Actions\Offerings\CreateOfferingAction;
use Bytelaunch\Nutristudents\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SiteTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }


    /**
     * @test
     */
    public function a_site_can_be_created(): void
    {

        $this->assertNotNull($this->site1->id);
    }

    /**
     * @test
     */
    public function a_guideline_can_be_created(): void
    {

        $this->assertNotNull($this->guideline1->id);
    }

    /**
     * @test
     */
    public function an_offering_can_be_created_and_attached_to_site(): void
    {
        $offering = (new CreateOfferingAction())
            ->setName('K-5 (Breakfast)')
            ->forSite($this->site1)
            ->forGuideline($this->guideline1)
            ->forMenuAdmin($this->group1)
            ->forOrderAdmin($this->user1)
            ->forPrepSite($this->site2)
            ->forCookSite($this->site3)
            ->create();


        $this->assertNotNull($offering->site());
        $this->assertNotNull($offering->guideline());
        $this->assertNotNull($offering->menu_adminable());
        $this->assertNotNull($offering->order_adminable());
        $this->assertNotNull($offering->prep_site());
        $this->assertNotNull($offering->cook_site());

    }

    /**
     * @test
     */
    public function a_sites_permissions_shows_all_permissable_users(): void
    {

    }

}
