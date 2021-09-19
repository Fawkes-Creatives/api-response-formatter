<?php
/**
 * @author fawkescreatives created on 17/09/2021
 */

namespace ApiResponse\Formatter\Tests\Unit;

use ApiResponse\Formatter\Facades\ApiResponse;
use ApiResponse\Formatter\Tests\Helpers\DataTrait;
use ApiResponse\Formatter\Tests\TestCase;
use ApiResponse\Formatter\Http\HttpStatusCode;

class ErrorTest extends TestCase
{
    use DataTrait;

    /** @test */
    public function it_only_call_error()
    {
        $data = ApiResponse::error()->getData(true);

        $this->assertCount(
            $this->getExpectedCount(),
            $data
        );
    }

    /** @test */
    public function its_status_value_is_false_error()
    {
        config()->set('api_response_format.status', false);
        $data = ApiResponse::error(null, [
            'status' => HttpStatusCode::NOT_FOUND
        ])->getData(true);
        $this->assertCount(
            $this->getExpectedCount(),
            $data
        );
        $this->assertArrayNotHasKey('status', $data);
    }

    /** @test */
    public function its_status_value_is_true_error()
    {
        config()->set('api_response_format.status', true);
        $data = ApiResponse::error(HttpStatusCode::NOT_FOUND)->getData(true);
        $this->assertCount(
            $this->getExpectedCount(),
            $data
        );
        $this->assertArrayHasKey('status', $data);
        $this->assertEquals(HttpStatusCode::NOT_FOUND, $data['status']);
    }

    /** @test */
    public function its_success_value_is_false_error()
    {
        config()->set('api_response_format.success', false);
        $data = ApiResponse::error()->getData(true);
        $this->assertCount(
            $this->getExpectedCount(),
            $data
        );
        $this->assertArrayNotHasKey('success', $data);
    }

    /** @test */
    public function its_success_value_is_true_error()
    {
        config()->set('api_response_format.success', true);
        $data = ApiResponse::error()->getData(true);
        $this->assertCount(
            $this->getExpectedCount(),
            $data
        );
        $this->assertArrayHasKey('success', $data);
        $this->assertEquals(false, $data['success']);
    }

    /** @test */
    public function its_message_value_is_false_error()
    {
        config()->set('api_response_format.message', false);
        $data = ApiResponse::error(HttpStatusCode::BAD_REQUEST, 'I am string')->getData(true);
        $this->assertCount(
            $this->getExpectedCount(),
            $data
        );
        $this->assertArrayNotHasKey('message', $data);
    }

    /** @test */
    public function its_message_value_is_true_error()
    {
        config()->set('api_response_format.message', true);
        $data = ApiResponse::error(HttpStatusCode::BAD_REQUEST, 'I am string')->getData(true);
        $this->assertCount(
            $this->getExpectedCount(),
            $data
        );
        $this->assertArrayHasKey('message', $data);
        $this->assertEquals('I am string', $data['message']);
    }

    /** @test */
    public function it_sending_data_to_it_error()
    {
        $count = 4;
        $data = ApiResponse::error(
            HttpStatusCode::BAD_REQUEST,
            'I am string',
            $this->getSingularArrayData(4)
        )->getData(true);

        $this->assertCount(
            $this->getExpectedCount(),
            $data
        );
        $this->assertArrayHasKey('data', $data);
        $this->assertCount($count, $data['data']);
    }
}