

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Lupa kata sandi? Masukkan email Anda, dan kami akan mengirimkan tautan untuk mereset kata sandi.') }}
        </div>

        <!-- Session Status -->
        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="flex items-center justify-between mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Kembali ke halaman login') }}
                </a>

                <x-button>
                    {{ __('Kirim tautan reset kata sandi') }}
                </x-button>
            </div>
        </form>

