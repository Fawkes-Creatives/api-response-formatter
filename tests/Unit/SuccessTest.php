<?php
/**
 * @author fawkescreatives created on 17/09/2021
 */

namespace ApiResponse\Formatter\Tests\Unit;

use ApiResponse\Formatter\Facades\ApiResponse;
use ApiResponse\Formatter\Tests\Helpers\DataTrait;
use ApiResponse\Formatter\Tests\TestCase;

class SuccessTest extends TestCase
{
    use DataTrait;

    /** @test */
    public function it_only_call()
    {
        $data = ApiResponse::success();

        $this->assertCount(
            $this->getExpectedCount(),
            $data
        );
    }

    /** @test */
    public function its_status_value_is_false()
    {
        config()->set('api_response_format.status', false);
        $data = ApiResponse::success(null, [
            'status' => 404
        ]);
        $this->assertCount(
            $this->getExpectedCount(),
            $data
        );
        $this->assertArrayNotHasKey('status', $data);
        $this->assertArrayNotHasKey('status_ref', $data);
    }

    /** @test */
    public function its_status_value_is_true()
    {
        config()->set('api_response_format.status', true);
        $data = ApiResponse::success(null, [
            'status' => 404
        ]);
        $this->assertCount(
            $this->getExpectedCount(),
            $data
        );
        $this->assertArrayHasKey('status', $data);
        $this->assertEquals(404, $data['status']);
    }

    /** @test */
    public function its_success_value_is_false()
    {
        config()->set('api_response_format.success', false);
        $data = ApiResponse::success(null, [
            'success' => true
        ]);
        $this->assertCount(
            $this->getExpectedCount(),
            $data
        );
        $this->assertArrayNotHasKey('success', $data);
    }

    /** @test */
    public function its_success_value_is_true()
    {
        config()->set('api_response_format.success', true);
        $data = ApiResponse::success(null, [
            'success' => false
        ]);
        $this->assertCount(
            $this->getExpectedCount(),
            $data
        );
        $this->assertArrayHasKey('success', $data);
        $this->assertEquals(false, $data['success']);
    }

    /** @test */
    public function its_message_value_is_false()
    {
        config()->set('api_response_format.message', false);
        $data = ApiResponse::success(null, [
            'message' => 'I am string'
        ]);
        $this->assertCount(
            $this->getExpectedCount(),
            $data
        );
        $this->assertArrayNotHasKey('message', $data);
    }

    /** @test */
    public function its_message_value_is_true()
    {
        config()->set('api_response_format.message', true);
        $data = ApiResponse::success(null, [
            'message' => 'I am string'
        ]);
        $this->assertCount(
            $this->getExpectedCount(),
            $data
        );
        $this->assertArrayHasKey('message', $data);
        $this->assertEquals('I am string', $data['message']);
    }

    /** @test */
    public function its_always_data_wrapping_value_is_false()
    {
        config()->set('api_response_format.always_data_wrapping', false);
        $data = ApiResponse::success();
        $this->assertCount(
            $this->getExpectedCount(),
            $data
        );
        $this->assertArrayNotHasKey('data', $data);
    }

    /** @test */
    public function its_always_data_wrapping_value_is_true()
    {
        config()->set('api_response_format.always_data_wrapping', true);
        $data = ApiResponse::success();
        $this->assertCount(
            $this->getExpectedCount(),
            $data
        );
        $this->assertArrayHasKey('data', $data);
        $this->assertNull($data['data']);
    }

    /** @test */
    public function it_sending_data_to_it()
    {
        $count = 4;
        $data = ApiResponse::success(
            $this->getMultidimensionalArrayData($count)
        );

        $this->assertCount(
            $this->getExpectedCount(),
            $data
        );
        $this->assertArrayHasKey('data', $data);
        $this->assertCount($count, $data['data']);
    }
}