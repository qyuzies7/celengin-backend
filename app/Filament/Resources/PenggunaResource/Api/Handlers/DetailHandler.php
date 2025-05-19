<?php

namespace App\Filament\Resources\PenggunaResource\Api\Handlers;

use App\Filament\Resources\SettingResource;
use App\Filament\Resources\PenggunaResource;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Http\Request;
use App\Filament\Resources\PenggunaResource\Api\Transformers\PenggunaTransformer;

class DetailHandler extends Handlers
{
    public static string | null $uri = '/{id}';
    public static string | null $resource = PenggunaResource::class;


    /**
     * Show Pengguna
     *
     * @param Request $request
     * @return PenggunaTransformer
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

        return new PenggunaTransformer($query);
    }
}
