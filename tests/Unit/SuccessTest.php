<?php
/**
 * @author fawkescreatives created on 17/09/2021
 */

namespace LaravelIntuition\Tests\Unit;

use LaravelIntuition\Facades\Intuition;
use LaravelIntuition\Tests\Helpers\DataTrait;
use LaravelIntuition\Tests\TestCase;
use LaravelIntuition\Http\HttpStatusCode;

class SuccessTest extends TestCase
{
    use DataTrait;

    /** @test */
    public function it_only_call_success()
    {
        $data = Intuition::success()->getData(true);

        $this->assertCount(
            $this->getExpectedCount(),
            $data
        );
    }

    /** @test */
    public function its_status_value_is_false_success()
    {
        config()->set('intuition.status', false);
        $data = Intuition::success(null, [
            'status' => HttpStatusCode::ACCEPTED
        ])->getData(true);
        $this->assertCount(
            $this->getExpectedCount(),
            $data
        );
        $this->assertArrayNotHasKey('status', $data);
        $this->assertArrayNotHasKey('status_ref', $data);
    }

    /** @test */
    public function its_status_value_is_true_success()
    {
        config()->set('intuition.status', true);
        $data = Intuition::success(null, [
            'status' => HttpStatusCode::NO_CONTENT
        ])->getData(true);
        $this->assertCount(
            $this->getExpectedCount(),
            $data
        );
        $this->assertArrayHasKey('status', $data);
        $this->assertEquals(HttpStatusCode::NO_CONTENT, $data['status']);
    }

    /** @test */
    public function its_success_value_is_false_success()
    {
        config()->set('intuition.success', false);
        $data = Intuition::success(null, [
            'success' => true
        ])->getData(true);
        $this->assertCount(
            $this->getExpectedCount(),
            $data
        );
        $this->assertArrayNotHasKey('success', $data);
    }

    /** @test */
    public function its_success_value_is_true_success()
    {
        config()->set('intuition.success', true);
        $data = Intuition::success(null, [
            'success' => false
        ])->getData(true);
        $this->assertCount(
            $this->getExpectedCount(),
            $data
        );
        $this->assertArrayHasKey('success', $data);
        $this->assertNotEquals(false, $data['success']);
    }

    /** @test */
    public function its_message_value_is_false_success()
    {
        config()->set('intuition.message', false);
        $data = Intuition::success(null, [
            'message' => 'I am string'
        ])->getData(true);
        $this->assertCount(
            $this->getExpectedCount(),
            $data
        );
        $this->assertArrayNotHasKey('message', $data);
    }

    /** @test */
    public function its_message_value_is_true_success()
    {
        config()->set('intuition.message', true);
        $data = Intuition::success(null, [
            'message' => 'I am string'
        ])->getData(true);
        $this->assertCount(
            $this->getExpectedCount(),
            $data
        );
        $this->assertArrayHasKey('message', $data);
        $this->assertEquals('I am string', $data['message']);
    }

    /** @test */
    public function it_sending_data_to_it_success()
    {
        $count = 4;
        $data = Intuition::success(
            $this->getMultidimensionalArrayData($count)
        )->getData(true);

        $this->assertCount(
            $this->getExpectedCount(),
            $data
        );
        $this->assertArrayHasKey('data', $data);
        $this->assertCount($count, $data['data']);
    }
}
