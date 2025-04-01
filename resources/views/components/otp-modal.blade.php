<div id="otpModal" class="fixed inset-0 bg-black text-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg p-6 max-w-sm w-full">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold">Verify Phone Number</h3>
            <button id="closeOtpModal" class="text-gray-500 hover:text-gray-700">
                &times;
            </button>
        </div>
        <div id="otpMessage" class="mb-4 p-2 bg-yellow-100 text-center hidden">
            <p class="font-bold">LOCAL DEVELOPMENT OTP:</p>
            <p id="displayOtp" class="text-2xl"></p>
            <p class="text-sm">(In production, this would be sent via SMS)</p>
        </div>
        <form id="otpForm" method="POST" action="{{ route('verify.otp') }}">
            @csrf
            <div class="mb-4">
                <label for="otpInput" class="block mb-2">Enter OTP</label>
                <input type="text" id="otpInput" name="otp" 
                       class="w-full p-2 border rounded"
                       required
                       maxlength="6"
                       pattern="\d{6}"
                       title="Please enter the 6-digit OTP">
                <div id="otpError" class="text-red-500 mt-1 hidden"></div>
            </div>
            
            <div class="flex justify-between items-center">
                <button type="submit" class="bg-blue-500 px-4 py-2 rounded text-black hover:bg-blue-600">
                    Verify
                </button>
                <button type="button" id="resendOtp" class="text-blue-500 hover:underline">
                    Resend OTP
                </button>
            </div>
        </form>
    </div>
</div>

