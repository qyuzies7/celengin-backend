<?php
namespace App\Filament\Resources\OutcomeResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\OutcomeResource;
use Illuminate\Routing\Router;


class OutcomeApiService extends ApiService
{
    protected static string | null $resource = OutcomeResource::class;

    public static function handlers() : array
    {
        return [
            Handlers\CreateHandler::class,
            Handlers\UpdateHandler::class,
            Handlers\DeleteHandler::class,
            Handlers\PaginationHandler::class,
            Handlers\DetailHandler::class
        ];

    }
}
