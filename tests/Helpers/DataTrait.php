<?php
/**
 * @author fawkescreatives created on 17/09/2021
 */

namespace ApiResponse\Formatter\Tests\Helpers;

use Faker\Factory;

trait DataTrait
{
    public function getConfig(): array
    {
        return config('api_response_format');
    }

    public function getSingularArrayData($count = 5): array
    {
        $faker = Factory::create();

        return $faker->sentences($count);
    }

    public function getMultidimensionalArrayData($count = 5): array
    {
        $output = [];
        for ($i = 0; $i < $count; $i++) {
            array_push($output, $this->getSingularArrayData());
        }
        return $output;
    }
}