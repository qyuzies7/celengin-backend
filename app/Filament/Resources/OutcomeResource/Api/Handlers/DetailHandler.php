<?php

namespace App\Filament\Resources\OutcomeResource\Api\Handlers;

use App\Filament\Resources\SettingResource;
use App\Filament\Resources\OutcomeResource;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Http\Request;
use App\Filament\Resources\OutcomeResource\Api\Transformers\OutcomeTransformer;

class DetailHandler extends Handlers
{
    public static string | null $uri = '/{id}';
    public static string | null $resource = OutcomeResource::class;


    /**
     * Show Outcome
     *
     * @param Request $request
     * @return OutcomeTransformer
     */
    public function handler(Request $request)
    {
        $id = $request->route('id');
        
        $query = static::getEloquentQuery();

        $query = QueryBuilder::for(
            $query->where(static::getKeyName(), $id)
        )
            ->first();

        if (!$query) return static::sendNotFoundResponse();

        return new OutcomeTransformer($query);
    }
}
