<?php
namespace App\Filament\Resources\OutcomeResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\OutcomeResource;
use App\Filament\Resources\OutcomeResource\Api\Requests\UpdateOutcomeRequest;

class UpdateHandler extends Handlers {
    public static string | null $uri = '/{id}';
    public static string | null $resource = OutcomeResource::class;

    public static function getMethod()
    {
        return Handlers::PUT;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }


    /**
     * Update Outcome
     *
     * @param UpdateOutcomeRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(UpdateOutcomeRequest $request)
    {
        $id = $request->route('id');

        $model = static::getModel()::find($id);

        if (!$model) return static::sendNotFoundResponse();

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Update Resource");
    }
}