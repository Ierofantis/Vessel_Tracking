<?php

namespace App\Http\Middleware;
use App\Models\UserIp;
use Carbon\Carbon;

use Closure;

class LimiterPerIp
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request,Closure $next)
    {
        $requestUserIp = UserIp::where('ip', $request->ip())->get();

        if(count($requestUserIp) === 0){
           UserIp::create(['ip' => $request->ip()]);
        }

        else{
            try {
               foreach ($requestUserIp as $item) {
                if(Carbon::now()->format('h') - Carbon::parse($item['created_at'])->format('h') >= 10){
                 \Log::error($item['ip'] . ' have exceeded the limit of requests.');
                 return response('You have exceeded the limit of requests.', 401);
                }
             }
            } catch (\Exception $e) {
                \Log::error($e->getMessage());
            }
        }
        return $next($request);
  }
}
