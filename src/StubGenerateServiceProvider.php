<?php
/**
 * @author naingminkhant created on 17/09/2021
 */

namespace ApiResponse\Formatter;

use Illuminate\Database\Migrations\MigrationCreator;

class StubGenerateServiceProvider extends MigrationCreator
{
    protected function getStub($table, $create)
    {
        return __DIR__.'/stubs';
    }
}