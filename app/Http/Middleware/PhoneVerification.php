<?php

namespace App\Http\Middleware;

use Closure;

class PhoneVerification
{
    /**
     * The list of allowed urls.
     *
     * @var array
     */
    protected $except = [
        'confirm/code',
        'confirm/phone',
        'confirm/email',
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $exception = false;

        foreach ($this->except as $path)
        {
            if (strpos($request->path(), $path) !== false)
            {
                $exception = true;
                break;
            }
        }

        if ($request->user() && ! $request->user()->phone_verified && ! $exception) {
            return redirect('/confirm/phone');
        }

        return $next($request);
    }
}
