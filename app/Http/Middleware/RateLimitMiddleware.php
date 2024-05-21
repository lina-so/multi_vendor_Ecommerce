<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Cache\RateLimiter;
use Symfony\Component\HttpFoundation\Response;

class RateLimitMiddleware
{
    public $limiter;

    public function __construct(RateLimiter $limiter)
    {
        $this->limiter = $limiter;
    }

    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user(); // يفترض أن تحتوي على كائن المستخدم المتوفر بعد المصادقة

        $executed = $this->limiter->attempt(
            'send-message:'.$user->id,
            $perMinute = 1,
            function () use ($user) {
                return true; // يتم السماح بالإرسال
            }
        );

        if (! $executed) {
            return response('Too many messages sent!', 429); // رفض الإرسال بسبب الحدود
        }

        return $next($request);
    }
}
