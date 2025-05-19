<?php
namespace App\Filament\Resources\PenggunaResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\PenggunaResource;
use App\Filament\Resources\PenggunaResource\Api\Requests\CreatePenggunaRequest;

class CreateHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = PenggunaResource::class;

    public static function getMethod()
    {
        return Handlers::POST;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }

    /**
     * Create Pengguna
     *
     * @param CreatePenggunaRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(CreatePenggunaRequest $request)
    {
        $model = new (static::getModel());

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Create Resource");
    }
}