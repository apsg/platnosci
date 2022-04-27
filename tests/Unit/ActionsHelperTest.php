<?php
namespace Tests\Unit;

use App\Domains\Actions\ActionsHelper;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ActionsHelperTest extends TestCase
{
    use WithFaker;

    /** @test */
    public function it_converts_email_to_name()
    {
        // given
        $email = $this->faker->email();

        // when
        $name = ActionsHelper::emailToName($email);

        // then
        $this->assertFalse(strpos($name, '@'));
    }
}
