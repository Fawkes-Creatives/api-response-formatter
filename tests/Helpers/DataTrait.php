<?php
/**
 * @author fawkescreatives created on 17/09/2021
 */

namespace LaravelIntuition\Tests\Helpers;

use Faker\Factory;

trait DataTrait
{
    public function getResponseKeys(): array
    {
        return array_filter(config('intuition'), function ($item) {
            return is_bool($item);
        });
    }

    public function getExpectedCount(): int
    {
        $output = count(
            array_filter($this->getResponseKeys(), function ($value) {
                return $value;
            })
        );

        if ($this->getResponseKeys()['status']) {
            $output += 1;
        }

        return $output + 1;
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
