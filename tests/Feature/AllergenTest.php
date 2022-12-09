<?php

namespace Bytelaunch\Nutristudents\Tests\Feature;

use Bytelaunch\Nutristudents\Actions\Allergens\CreateAllergensAction;
use Bytelaunch\Nutristudents\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AllergenTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }


    /**
     * @test
     */
    public function an_allergen_can_be_created(): void
    {
        $allergen = (new CreateAllergensAction)
                        ->setName('new allergen')
                        ->create();
        $this->assertNotNull($allergen->id);
    }

}
