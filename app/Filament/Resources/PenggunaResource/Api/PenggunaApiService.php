<?php
namespace App\Filament\Resources\PenggunaResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\PenggunaResource;
use Illuminate\Routing\Router;


class PenggunaApiService extends ApiService
{
    protected static string | null $resource = PenggunaResource::class;

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
