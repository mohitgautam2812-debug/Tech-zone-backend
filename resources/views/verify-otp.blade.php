<x-guest-layout>
    <div class="w-full max-w-md mx-auto bg-white shadow rounded p-6">

        <h3 class="mb-3">Enter OTP</h3>

        @if(session('error'))
            <div class="bg-red-100 p-2 mb-3">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('otp.verify') }}">
            @csrf

            <input type="text" name="otp" class="w-full border p-2 mb-3" placeholder="Enter OTP">

            <button class="bg-blue-500 text-white px-4 py-2 w-full">
                Verify OTP
            </button>
        </form>

    </div>
</x-guest-layout>