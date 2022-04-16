<?php
namespace Tests\Payu;

use App\Domains\Payu\Elements\Buyer;
use App\Domains\Payu\Elements\Product;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ElementsTest extends TestCase
{
    use WithFaker;

    /** @test */
    public function it_converts_product_to_array()
    {
        // given
        $price = $this->faker->numberBetween(2, 10000);
        $count = $this->faker->numberBetween(1, 10);
        $name = $this->faker->sentence(3);

        // when
        $product = new Product($name, $price, $count);
        $productArrayed = $product->toArray();

        // then
        $this->assertTrue(is_array($productArrayed));
        $this->assertCount(3, $productArrayed);
        $this->assertEquals($name, $productArrayed['name']);
        $this->assertEquals($count, $productArrayed['quantity']);
        $this->assertEquals($price, $productArrayed['unitPrice']);
    }

    /** @test */
    public function it_ommits_empty_elements()
    {
        // given
        $email = $this->faker->email();
        $phone = '';
        $firstName = $this->faker->firstName();
        $lastName = null;

        // when
        $buyer = new Buyer($email, $phone, $firstName, $lastName);
        $buyerArrayed = $buyer->toArray();

        // then
        $this->assertCount(2, $buyerArrayed);
        $this->assertArrayHasKey('email', $buyerArrayed);
        $this->assertArrayHasKey('firstName', $buyerArrayed);
        $this->assertArrayNotHasKey('phone', $buyerArrayed);
        $this->assertArrayNotHasKey('lastName', $buyerArrayed);
        $this->assertEquals($email, $buyerArrayed['email']);
        $this->assertEquals($firstName, $buyerArrayed['firstName']);
    }
}
