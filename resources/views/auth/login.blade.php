<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
        <img src="../GKJ.png" class="block h-24 sm:w-auto">
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                <div class="custom-show-hide">  
                    <a id="eye" toggle="#password-field" class="field_icon toggle-password custom-font">
                        <i class="fas fa-eye"></i> Show
                    </a>
                </div>
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <input id="remember_me" type="checkbox" class="form-checkbox" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <!-- @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif -->

                <x-jet-button class="ml-4">
                    {{ __('Login') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>

<script>
    $("body").on('click', '.toggle-password', function() {
        var input = $("#password");
        var eye = $("#eye");
        if (input.attr("type") === "password") {
            input.attr("type", "text");
            eye.html("").html("<i class='fas fa-eye-slash'></i> Hide");
        } else {
            input.attr("type", "password");
            eye.html("").html("<i class='fas fa-eye'></i> Show");
        }
    });
</script>
