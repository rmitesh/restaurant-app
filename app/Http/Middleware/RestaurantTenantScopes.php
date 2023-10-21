<?php

namespace App\Http\Middleware;

use App\Models\Restaurant;
use App\Models\User;
use Closure;
use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RestaurantTenantScopes
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->hasRole([
            User::ROLE_RESTAURANT_OWNER,
        ])) {
            Restaurant::addGlobalScope('restaurant', function (Builder $query) {
                $query->whereBelongsTo(Filament::getTenant());
            });
        }

        return $next($request);
    }
}
