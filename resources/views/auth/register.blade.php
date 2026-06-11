<x-guest-layout>

    <div class="w-full max-w-md mx-auto bg-white shadow-xl rounded-2xl p-6">

        @if(session('error'))
            <div class="bg-red-100 p-2 mb-3">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" class="w-full border p-2" required>
            </div>

            <div class="mb-3">
                <label>Register As</label>
                <select name="type" class="w-full border p-2">
                    <option value="user">User</option>
                    <option value="agent">Agent</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Phone Number</label>
                <input type="text" name="phone" maxlength="10" class="w-full border p-2"
                    oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,10);">
            </div>


            <div class="mb-3">
                <label>Email</label>
                <div style="display:flex; gap:5px;">
                    <input id="email" type="email" name="email" class="w-full border p-2" required>

                    <button type="button" onclick="sendOtp()" style="background:red;color:white;padding:5px 10px;">
                        OTP
                    </button>
                </div>
            </div>

            <div class="mb-3">
                <label>OTP</label>
                <input type="text" name="otp" class="w-full border p-2" required>
            </div>

            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="w-full border p-2" required>
            </div>

            <div class="mb-3">
                <label>Confirm Password</label>
                <input type="password" name="password_confirmation" class="w-full border p-2" required>
            </div>

            <button class="w-full bg-red-600 text-white p-2">
                Register
            </button>
        </form>

    </div>

    <script>
        function sendOtp() {
            let email = document.getElementById('email').value;

            if (!email) {
                alert('Enter email first');
                return;
            }

            fetch('/send-otp', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ email: email })
            })
                .then(res => res.json())
                .then(data => alert(data.message));
        }
    </script>

</x-guest-layout>