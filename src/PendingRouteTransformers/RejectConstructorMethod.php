<?php

namespace Spatie\RouteDiscovery\PendingRouteTransformers;

use Illuminate\Support\Collection;
use Spatie\RouteDiscovery\PendingRoutes\PendingRoute;
use Spatie\RouteDiscovery\PendingRoutes\PendingRouteAction;

class RejectConstructorMethod implements \Spatie\RouteDiscovery\PendingRouteTransformers\PendingRouteTransformer
{
    /**
     * @param Collection<PendingRoute> $pendingRoutes
     *
     * @return Collection<PendingRoute>
     */
    public function transform(Collection $pendingRoutes): Collection
    {
        return $pendingRoutes->each(function (PendingRoute $pendingRoute) {
            $pendingRoute->actions = $pendingRoute
                ->actions
                ->reject(fn(PendingRouteAction $pendingRouteAction) => $pendingRouteAction->method->name == '__construct');
        });
    }
}

