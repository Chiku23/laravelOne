<div id="otpModal" class="fixed inset-0 bg-slate-950/80 backdrop-blur-sm flex items-center justify-center z-50 hidden">
    <div class="bg-slate-900 border border-slate-800 rounded-3xl p-8 max-w-sm w-full shadow-2xl relative">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-xl font-bold text-slate-100">Verify Your Email</h3>
            <button id="closeOtpModal" class="text-slate-400 hover:text-slate-200 transition-colors p-1">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
        </div>
        <form id="otpForm" method="POST" action="{{ route('verify.otp') }}" class="space-y-4">
            @csrf
            <div class="space-y-2">
                <label for="otpInput" class="block text-sm font-semibold text-slate-300">Enter OTP code sent to your email:</label>
                <input type="text" id="otpInput" name="otp" 
                       class="w-full px-4 py-3 rounded-xl bg-slate-950/60 border border-slate-800 text-slate-100 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all text-center text-lg tracking-widest font-mono"
                       required
                       placeholder="000000"
                       maxlength="6"
                       pattern="\d{6}"
                       title="Please enter the 6-digit OTP">
                <div id="otpError" class="text-rose-400 text-xs mt-1 font-semibold hidden"></div>
            </div>
            
            <div class="flex items-center justify-between pt-4">
                <button type="submit" class="px-5 py-2.5 rounded-xl text-sm font-bold text-white bg-indigo-650 hover:bg-indigo-600 focus:outline-none transition-colors">
                    Verify Code
                </button>
                <button type="button" id="resendOtp" class="text-sm font-bold text-indigo-400 hover:text-indigo-300 transition-colors underline decoration-2 underline-offset-4">
                    Resend OTP
                </button>
            </div>
        </form>
    </div>
</div>

