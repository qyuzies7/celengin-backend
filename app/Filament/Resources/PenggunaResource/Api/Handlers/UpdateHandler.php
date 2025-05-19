<?php
namespace App\Filament\Resources\PenggunaResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\PenggunaResource;
use App\Filament\Resources\PenggunaResource\Api\Requests\UpdatePenggunaRequest;

class UpdateHandler extends Handlers {
    public static string | null $uri = '/{id}';
    public static string | null $resource = PenggunaResource::class;

    public static function getMethod()
    {
        return Handlers::PUT;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }


    /**
     * Update Pengguna
     *
     * @param UpdatePenggunaRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(UpdatePenggunaRequest $request)
    {
        $id = $request->route('id');

        $model = static::getModel()::find($id);

        if (!$model) return static::sendNotFoundResponse();

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Update Resource");
    }
}