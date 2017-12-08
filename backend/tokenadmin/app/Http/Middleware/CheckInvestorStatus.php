<?php

    namespace App\Http\Middleware;

    use Closure;
    use Illuminate\Http\RedirectResponse;
    use App\Models\Investor;

    class CheckInvestorStatus {

        /**
         * Handle an incoming request.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  \Closure  $next
         * @return mixed
         */
        public function handle($request, Closure $next) {
            $oInvestor = Investor::find($request->id);

            if ($oInvestor->status == Investor::STATUS_PENDING || ($oInvestor->prflag == 1 && $oInvestor->status != Investor::STATUS_REJECTED)) {
                return $next($request);
            }
            
            //return new RedirectResponse(url('/'));
			return redirect()->back()->with('authmessage', 'Investor can not be edited once '.$oInvestor->status);
        }

    }
    