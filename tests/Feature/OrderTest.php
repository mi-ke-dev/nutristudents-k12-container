<?php

namespace Bytelaunch\Nutristudents\Tests\Feature;

use Bytelaunch\Nutristudents\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }


    /**
     * @test
     */
    public function an_order_can_be_created(): void
    {

    }

    /**
     * @test
     */
    public function an_order_item_can_be_added(): void
    {
        // products

    }

    /**
     * @test
     */
    public function an_order_knows_which_weekcycles_it_pertains_to(): void
    {

    }

    /**
     * @test
     */
    public function an_order_knows_the_total_meals_required(): void
    {

    }

    /**
     * @test
     */
    public function an_onhand_amount_can_be_entered_for_products(): void
    {

    }

    /**
     * @test
     */
    public function an_order_report_can_be_exported(): void
    {

    }

}
