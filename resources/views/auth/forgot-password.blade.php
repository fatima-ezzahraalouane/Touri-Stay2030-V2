<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TouriStay 2030 - Réinitialisation du mot de passe</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .worldcup-gradient {
            background: linear-gradient(135deg, #862633 0%, #009A44 100%);
        }
        .reset-card {
            animation: fadeIn 0.5s ease-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .form-input:focus {
            border-color: #862633;
            box-shadow: 0 0 0 2px rgba(134, 38, 51, 0.1);
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center">
                    <a href="" class="flex items-center">
                        <i class="fas fa-futbol text-[#862633] text-2xl mr-2"></i>
                        <span class="text-2xl font-bold">
                            TouriStay 2030
                        </span>
                    </a>
                </div>

                <!-- <div class="flex items-center space-x-4">
                    <a href="{{ route('login') }}" 
                       class="text-[#862633] hover:text-[#009A44] transition-colors duration-300 flex items-center">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        Se connecter
                    </a>
                    <a href="{{ route('register') }}" 
                       class="text-[#862633] hover:text-[#009A44] transition-colors duration-300 flex items-center">
                        <i class="fas fa-user-plus mr-2"></i>
                        S'inscrire
                    </a>
                </div> -->
            </div>
        </div>
    </nav>
    <div class="container mx-auto px-4 py-12">
        <!-- Password Reset Form Card -->
        <div class="max-w-md mx-auto reset-card">
            <!-- Card Header -->
            <div class="worldcup-gradient rounded-t-xl shadow-lg p-6">
                <h1 class="text-2xl font-bold text-white text-center flex items-center justify-center">
                    <i class="fas fa-key mr-3"></i>
                    Mot de passe oublié
                </h1>
                <p class="text-white text-center mt-2">
                    Récupérez l'accès à votre compte TouriStay 2030
                </p>
            </div>

            <!-- Card Body -->
            <div class="bg-white rounded-b-xl shadow-lg p-8">
                <div class="mb-6 text-[#862633]/90 bg-[#862633]/5 p-4 rounded-lg border-l-4 border-[#862633]">
                    <i class="fas fa-info-circle text-[#862633] mr-2"></i>
                    Indiquez-nous votre adresse e-mail et nous vous enverrons un lien de réinitialisation sécurisé.
                </div>

                <!-- Session Status -->
                @if (session('status'))
                    <div class="bg-[#009A44]/10 border-l-4 border-[#009A44] text-[#009A44] p-4 mb-6" role="alert">
                        <p class="flex items-center">
                            <i class="fas fa-check-circle mr-2"></i>
                            {{ session('status') }}
                        </p>
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="mb-6">
                        <label for="email" class="block text-sm font-medium text-[#862633] mb-2">
                            Adresse email
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="far fa-envelope text-[#009A44]"></i>
                            </div>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus 
                                   class="w-full border border-gray-300 rounded-lg pl-10 py-3 focus:outline-none focus:ring-2 focus:ring-[#862633]/20 focus:border-[#862633] transition-all"
                                   placeholder="Entrer votre adresse email">
                        </div>
                        @error('email')
                            <p class="text-[#862633] text-sm mt-1 flex items-center">
                                <i class="fas fa-exclamation-circle mr-2"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" 
                            class="w-full worldcup-gradient text-white px-6 py-3 rounded-lg font-bold shadow-lg transition duration-300 hover:opacity-90 flex items-center justify-center">
                        <i class="fas fa-paper-plane mr-2"></i>
                        Envoyer le lien de réinitialisation
                    </button>

                    <!-- Back to Login Link -->
                    <div class="mt-6 text-center">
                        <a href="{{ route('login') }}" 
                           class="text-[#862633] hover:text-[#009A44] font-medium transition-colors duration-300 flex items-center justify-center">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Retour à la page de connexion
                        </a>
                    </div>
                </form>
            </div>

            <!-- Quick Links -->
            <!-- <div class="bg-white rounded-xl shadow-lg p-6 mt-8">
                <h2 class="text-xl font-bold text-[#862633] mb-4 flex items-center">
                    <i class="fas fa-link mr-2"></i>
                    Accès rapides
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <a href="" class="bg-gray-50 hover:bg-[#862633]/5 rounded-lg p-4 flex items-center transition-all duration-300">
                        <div class="rounded-full bg-[#862633]/10 p-3 mr-3">
                            <i class="fas fa-home text-[#862633]"></i>
                        </div>
                        <span class="text-gray-700">Accueil</span>
                    </a>
                    <a href="#" class="bg-gray-50 hover:bg-[#009A44]/5 rounded-lg p-4 flex items-center transition-all duration-300">
                        <div class="rounded-full bg-[#009A44]/10 p-3 mr-3">
                            <i class="fas fa-info-circle text-[#009A44]"></i>
                        </div>
                        <span class="text-gray-700">À propos</span>
                    </a>
                    <a href="#" class="bg-gray-50 hover:bg-[#862633]/5 rounded-lg p-4 flex items-center transition-all duration-300">
                        <div class="rounded-full bg-[#862633]/10 p-3 mr-3">
                            <i class="fas fa-question-circle text-[#862633]"></i>
                        </div>
                        <span class="text-gray-700">Aide</span>
                    </a>
                </div>
            </div> -->
        </div>
    </div>

    <!-- Footer -->
    <footer class="worldcup-gradient text-white mt-12 py-8">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Brand Section -->
                <div>
                    <h3 class="text-xl font-bold mb-4 flex items-center">
                        <i class="fas fa-futbol mr-2"></i>
                        WorldCup 2030
                    </h3>
                    <p class="text-white/80">
                        Votre plateforme officielle d'hébergement pour la Coupe du Monde 2030.
                    </p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-xl font-bold mb-4">Liens rapides</h3>
                    <ul class="space-y-2">
                        <li>
                            <a href="#" class="text-white/80 hover:text-white transition-colors duration-300 flex items-center">
                                Accueil
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-white/80 hover:text-white transition-colors duration-300 flex items-center">
                                Comment ça marche
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-white/80 hover:text-white transition-colors duration-300 flex items-center">
                                À propos
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-white/80 hover:text-white transition-colors duration-300 flex items-center">
                                Contact
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h3 class="text-xl font-bold mb-4">Contact</h3>
                    <ul class="space-y-3">
                        <li class="flex items-center text-white/80">
                            <i class="fas fa-envelope mr-3"></i>
                            contact@touristay2030.com
                        </li>
                        <li class="flex items-center text-white/80">
                            <i class="fas fa-phone mr-3"></i>
                            +212 5XX XXX XXX
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Copyright -->
            <div class="border-t border-white/20 mt-8 pt-6 text-center">
                <p class="text-white/80">
                    &copy; TouriStay 2030. Tous droits réservés.
                </p>
            </div>
        </div>
    </footer>
</body>
</html>