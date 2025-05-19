<?php
namespace App\Filament\Resources\OutcomeResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\OutcomeResource;
use App\Filament\Resources\OutcomeResource\Api\Requests\CreateOutcomeRequest;

class CreateHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = OutcomeResource::class;

    public static function getMethod()
    {
        return Handlers::POST;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }

    /**
     * Create Outcome
     *
     * @param CreateOutcomeRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(CreateOutcomeRequest $request)
    {
        $model = new (static::getModel());

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Create Resource");
    }
}