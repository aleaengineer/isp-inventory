<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ActivityLog;

class LogActivity
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if (Auth::check() && $request->method() !== 'GET') {
            $route = $request->route();
            $modelType = null;
            $modelId = null;

            if ($route && $route->hasParameter('item')) {
                $modelType = 'App\Models\Item';
                $modelId = $route->parameter('item') instanceof \App\Models\Item
                    ? $route->parameter('item')->id
                    : $route->parameter('item');
            } elseif ($route && $route->hasParameter('category')) {
                $modelType = 'App\Models\Category';
                $modelId = $route->parameter('category') instanceof \App\Models\Category
                    ? $route->parameter('category')->id
                    : $route->parameter('category');
            } elseif ($route && $route->hasParameter('transaction')) {
                $modelType = 'App\Models\Transaction';
                $modelId = $route->parameter('transaction') instanceof \App\Models\Transaction
                    ? $route->parameter('transaction')->id
                    : $route->parameter('transaction');
            } elseif ($route && $route->hasParameter('supplier')) {
                $modelType = 'App\Models\Supplier';
                $modelId = $route->parameter('supplier') instanceof \App\Models\Supplier
                    ? $route->parameter('supplier')->id
                    : $route->parameter('supplier');
            } elseif ($route && $route->hasParameter('user')) {
                $modelType = 'App\Models\User';
                $modelId = $route->parameter('user') instanceof \App\Models\User
                    ? $route->parameter('user')->id
                    : $route->parameter('user');
            }

            ActivityLog::create([
                'user_id'    => Auth::id(),
                'action'     => $request->method(),
                'model_type' => $modelType,
                'model_id'   => $modelId,
                'description' => $this->getDescription($request),
                'ip_address' => $request->ip(),
            ]);
        }

        return $response;
    }

    private function getDescription(Request $request): string
    {
        $method = $request->method();
        $path = $request->path();

        $actions = [
            'POST'   => 'Membuat data baru di ',
            'PUT'    => 'Memperbarui data di ',
            'PATCH'  => 'Memperbarui data di ',
            'DELETE' => 'Menghapus data di ',
        ];

        return ($actions[$method] ?? 'Mengakses ') . $path;
    }
}
