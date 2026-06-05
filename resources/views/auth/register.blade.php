@section('auth-title', 'Prêt à organiser ta recherche ?')
@section('auth-description', 'Crée ton compte en quelques secondes et prends le contrôle de tes candidatures.')
@section('auth-heading', 'Créer un compte')
@section('auth-subheading', 'Commence à suivre tes candidatures')

<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1.5">Nom complet</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                   placeholder="Marie Dupont"
                   class="input-field @error('name') border-red-400 @enderror">
            <x-input-error :messages="$errors->get('name')" class="mt-1.5" />
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1.5">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                   placeholder="ton@email.com"
                   class="input-field @error('email') border-red-400 @enderror">
            <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1.5">Mot de passe</label>
            <input id="password" type="password" name="password" required autocomplete="new-password"
                   placeholder="••••••••"
                   class="input-field @error('password') border-red-400 @enderror">
            <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1.5">Confirmer le mot de passe</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                   placeholder="••••••••"
                   class="input-field @error('password_confirmation') border-red-400 @enderror">
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1.5" />
        </div>

        <button type="submit" class="btn-primary w-full">Créer mon compte</button>
    </form>

    <p class="text-center text-sm text-gray-500 mt-6">
        Déjà un compte ?
        <a href="{{ route('login') }}" class="font-medium text-primary-500 hover:text-primary-600 transition-colors">Se connecter</a>
    </p>
</x-guest-layout>
