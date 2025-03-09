<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TouriStay 2030 - Notifications</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .worldcup-gradient {
            background: linear-gradient(135deg, #862633 0%, #009A44 100%);
        }

        .notification-hover:hover {
            border-left: 4px solid #862633;
            transition: all 0.3s ease;
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center">
                    <a href="{{ route('proprietaire.dashboard') }}" class="flex items-center space-x-2">
                        <i class="fas fa-futbol text-[#862633] text-2xl"></i>
                        <span class="text-2xl font-bold">
                            Touri<span class="text-[#009A44]">Stay</span>
                            <span class="text-lg font-xl text-[#862633]">2030</span>
                        </span>
                    </a>
                </div>

                <div class="flex items-center space-x-4">
                    <button class="text-[#862633] hover:text-[#009A44] transition-colors duration-300">
                        <i class="far fa-bell text-xl"></i>
                    </button>
                    <a href="{{ route('profile.userprofile') }}" class="text-[#862633] hover:text-[#009A44] transition-colors duration-300">
                        <i class="far fa-user-circle text-xl"></i>
                    </a>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        class="worldcup-gradient text-white px-4 py-2 rounded-lg font-medium transition duration-300 hover:opacity-90">
                        <i class="fas fa-sign-out-alt mr-2"></i>
                        Déconnexion
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-[#862633] flex items-center">
                <i class="fas fa-bell mr-3"></i>
                Mes notifications
            </h1>

            <form action="{{ route('notifications.markAllAsRead') }}" method="POST">
                @csrf
                <button type="submit" class="text-[#009A44] hover:text-[#862633] transition-colors duration-300 flex items-center">
                    <i class="fas fa-check-double mr-2"></i>
                    Marquer tout comme lu
                </button>
            </form>
        </div>

        <div class="bg-white shadow-lg rounded-xl overflow-hidden">
            @if($notifications->count() > 0)
            <ul class="divide-y divide-gray-200">
                @foreach($notifications as $notification)
                <li class="p-6 hover:bg-gray-50 transition-all duration-300 notification-hover 
                            {{ $notification->read_at ? 'bg-white' : 'bg-[#862633]/5 border-l-4 border-[#862633]' }}">
                    <div class="flex justify-between">
                        <div>
                            <p class="text-gray-800 flex items-center">
                                <i class="fas fa-info-circle text-[#009A44] mr-2"></i>
                                {{ $notification->data['message'] }}
                            </p>
                            <p class="text-sm text-gray-500 mt-2 flex items-center">
                                <i class="far fa-clock text-[#862633] mr-2"></i>
                                {{ $notification->created_at->format('d/m/Y H:i') }}
                            </p>

                            @if(isset($notification->data['reservation_id']))
                            <a href="" class="inline-flex items-center mt-3 text-[#009A44] hover:text-[#862633] transition-colors duration-300">
                                <i class="fas fa-eye mr-2"></i>
                                Voir les détails
                            </a>
                            @endif
                        </div>

                        @if(!$notification->read_at)
                        <form action="{{ route('notifications.markAsRead', $notification->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="text-[#862633] hover:text-[#009A44] transition-colors duration-300 flex items-center">
                                <i class="fas fa-check mr-2"></i>
                                Marquer comme lu
                            </button>
                        </form>
                        @endif
                    </div>
                </li>
                @endforeach
            </ul>
            @else
            <div class="p-8 text-center">
                <i class="far fa-bell-slash text-[#862633] text-4xl mb-4"></i>
                <p class="text-gray-600">Vous n'avez aucune notification.</p>
            </div>
            @endif
        </div>
    </div>

    <!-- Footer -->
    <footer class="worldcup-gradient bg-[#862633] text-white mt-12 py-8">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4 flex items-center">
                        <span>TouriStay 2030</span>
                    </h3>
                    <p class="text-gray-300">La plateforme officielle d'hébergement pour la Coupe du Monde 2030.</p>
                </div>

                <div>
                    <h3 class="text-xl font-bold mb-4">Liens rapides</h3>
                    <ul class="space-y-3">
                        <li>
                            <a href="#" class="flex items-center text-gray-300 hover:text-white transition-colors duration-300">
                                <i class="fas fa-home mr-2 text-[#009A44]"></i>
                                Accueil
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center text-gray-300 hover:text-white transition-colors duration-300">
                                <i class="fas fa-futbol mr-2 text-[#009A44]"></i>
                                Mondial 2030
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center text-gray-300 hover:text-white transition-colors duration-300">
                                <i class="fas fa-info-circle mr-2 text-[#009A44]"></i>
                                À propos
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center text-gray-300 hover:text-white transition-colors duration-300">
                                <i class="fas fa-envelope mr-2 text-[#009A44]"></i>
                                Contact
                            </a>
                        </li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-xl font-bold mb-4">Nous contacter</h3>
                    <div class="space-y-3">
                        <div class="flex items-center text-gray-300">
                            <i class="fas fa-envelope mr-3 text-[#009A44]"></i>
                            <span>contact@touristay2030.com</span>
                        </div>
                        <div class="flex items-center text-gray-300">
                            <i class="fas fa-phone mr-3 text-[#009A44]"></i>
                            <span>+212 5XX XXX XXX</span>
                        </div>
                        <div class="flex items-center text-gray-300">
                            <i class="fas fa-map-marker-alt mr-3 text-[#009A44]"></i>
                            <span>Maroc - Espagne - Portugal</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="border-t border-white/20 mt-8 pt-6 text-center text-gray-300">
                <p>&copy; TouriStay 2030. Tous droits réservés.</p>
            </div>
        </div>
    </footer>
</body>

</html>