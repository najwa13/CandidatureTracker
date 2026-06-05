@section('auth-title', 'Connecte-toi pour gérer tes candidatures')
@section('auth-description', 'Suis chaque étape de ta recherche d\'emploi, organise tes entretiens et ne rate jamais une relance.')
@section('auth-heading', 'Bon retour !')
@section('auth-subheading', 'Connecte-toi pour gérer tes candidatures')

<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1.5">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                   placeholder="ton@email.com"
                   class="input-field @error('email') border-red-400 @enderror">
            <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1.5">Mot de passe</label>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                   placeholder="••••••••"
                   class="input-field @error('password') border-red-400 @enderror">
            <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
        </div>

        <div class="flex items-center justify-between">
            <label for="remember_me" class="flex items-center gap-2 cursor-pointer">
                <input id="remember_me" type="checkbox" name="remember"
                       class="rounded-lg border-gray-300 text-primary-500 focus:ring-primary-500 transition-colors">
                <span class="text-sm text-gray-600">Se souvenir de moi</span>
            </label>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-sm font-medium text-primary-500 hover:text-primary-600 transition-colors">
                    Mot de passe oublié ?
                </a>
            @endif
        </div>

        <button type="submit" class="btn-primary w-full">Se connecter</button>
    </form>

    <p class="text-center text-sm text-gray-500 mt-6">
        Pas encore de compte ?
        <a href="{{ route('register') }}" class="font-medium text-primary-500 hover:text-primary-600 transition-colors">S'inscrire</a>
    </p>
</x-guest-layout>
