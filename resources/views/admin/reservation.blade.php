<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TouriStay 2030 - Suivi des Paiements et Réservations</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .worldcup-gradient {
            background: linear-gradient(135deg, #862633 0%, #009A44 100%);
        }

        .worldcup-border {
            border-left: 4px solid #862633;
        }

        .worldcup-hover:hover {
            background: linear-gradient(135deg, #862633 0%, #009A44 100%);
            color: white;
        }

        .stats-card {
            transition: all 0.3s ease;
        }

        .stats-card:hover {
            transform: translateY(-5px);
        }
    </style>
</head>

<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="bg-gray-800 text-white w-64 flex-shrink-0">
            <div class="p-4 worldcup-gradient">
                <a href="#" class="text-2xl font-bold text-white flex items-center">
                    <i class="fas fa-futbol mr-2"></i>
                    TouriStay 2030
                </a>
                <p class="text-white/80 text-sm mt-1">Panneau d'administration</p>
            </div>
            <nav class="mt-5">
                <a href="{{Route('admin.dashboard')}}" class="flex items-center py-3 px-6 text-gray-300 hover:bg-gray-700 hover:text-white">
                    <i class="fas fa-tachometer-alt mr-3"></i>
                    <span>Tableau de bord</span>
                </a>

                <a href="{{Route('admin.reservation')}}" class="flex items-center py-3 px-6 bg-[#862633] text-white border-l-4 border-[#009A44]">
                    <i class="fas fa-money-bill-wave mr-3"></i>
                    <span>Paiements & Réservations</span>
                </a>

                <a href="" class="flex items-center py-3 px-6 text-gray-300 hover:bg-gray-700 hover:text-white">
                    <i class="fas fa-users mr-3"></i>
                    <span>Utilisateurs</span>
                </a>
                <a href="" class="flex items-center py-3 px-6 text-gray-300 hover:bg-gray-700 hover:text-white">
                    <i class="fas fa-flag mr-3"></i>
                    <span>Signalements</span>
                </a>
                <a href="#" class="flex items-center py-3 px-6 text-gray-300 hover:bg-gray-700 hover:text-white">
                    <i class="fas fa-cog mr-3"></i>
                    <span>Paramètres</span>
                </a>
            </nav>
            <div class="absolute bottom-0 w-64 p-4 bg-gray-900">
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="flex items-center text-gray-300 hover:text-white">
                    <i class="fas fa-sign-out-alt mr-3"></i>
                    <span>Déconnexion</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>



        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Navbar -->
            <header class="bg-white shadow-sm z-10">
                <div class="flex items-center justify-between p-4">
                    <div class="flex items-center">
                        <span class="text-gray-800 text-lg font-semibold">Suivi des Paiements et Réservations</span>
                    </div>
                    <div class="flex items-center space-x-4">
                        <button class="text-gray-500 hover:text-gray-700">
                            <i class="fas fa-bell text-xl"></i>
                        </button>
                        <div class="relative">
                            <button class="flex items-center text-gray-700 focus:outline-none">
                                <img src="admin.jpg" alt="Admin Avatar" class="h-8 w-8 rounded-full object-cover">
                                <span class="ml-2">Admin TouriStay</span>
                                <i class="fas fa-chevron-down ml-2 text-xs"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <main class="flex-1 overflow-y-auto p-6">
                <h1 class="text-2xl font-bold text-gray-800 mb-6">Suivi des Paiements et Réservations</h1>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex items-center">
                            <div class="rounded-full bg-green-100 p-3">
                                <i class="fas fa-euro-sign text-green-600 text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-gray-500 text-sm font-medium">Revenus du mois</h3>
                                <p class="text-2xl font-bold text-gray-800">45 890 €</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex items-center">
                            <div class="rounded-full bg-blue-100 p-3">
                                <i class="fas fa-calendar-check text-blue-600 text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-gray-500 text-sm font-medium">Réservations actives</h3>
                                <p class="text-2xl font-bold text-gray-800">378</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex items-center">
                            <div class="rounded-full bg-yellow-100 p-3">
                                <i class="fas fa-percentage text-yellow-600 text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-gray-500 text-sm font-medium">Taux d'occupation</h3>
                                <p class="text-2xl font-bold text-gray-800">68,5%</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex items-center">
                            <div class="rounded-full bg-red-100 p-3">
                                <i class="fas fa-exclamation-circle text-red-600 text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-gray-500 text-sm font-medium">Paiements en attente</h3>
                                <p class="text-2xl font-bold text-gray-800">24</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Charts Section -->
                <!-- <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-gray-800 text-lg font-semibold mb-4">Revenus mensuels (2025)</h2>
                        <div class="relative h-64">
                            <img src="/api/placeholder/600/250" alt="Graphique des revenus" class="w-full h-full object-cover rounded">
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-gray-800 text-lg font-semibold mb-4">Répartition des réservations par type</h2>
                        <div class="relative h-64">
                            <img src="/api/placeholder/600/250" alt="Graphique de répartition" class="w-full h-full object-cover rounded">
                        </div>
                    </div>
                </div> -->

                <!-- Latest Reservations -->
                <div class="bg-white rounded-lg shadow-md mb-8">
                    <div class="flex items-center justify-between p-6 border-b worldcup-gradient">
                        <h2 class="text-white text-lg font-semibold flex items-center">
                            <i class="fas fa-calendar-alt mr-2"></i>
                            Dernières réservations
                        </h2>
                        <!-- <a href="#" class="text-blue-600 hover:underline text-sm font-medium">Voir toutes</a> -->
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gray-50">
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hébergement</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Client</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dates</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Montant</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($reservations as $reservation)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">#{{ $reservation->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ optional($reservation->annonce)->titre ?? 'Annonce supprimée' }}
                                        (#{{ optional($reservation->annonce)->id ?? 'N/A' }})
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ optional($reservation->user)->name ?? 'Utilisateur supprimé' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ \Carbon\Carbon::parse($reservation->date_debut)->format('d M') }} -
                                        {{ \Carbon\Carbon::parse($reservation->date_fin)->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ number_format($reservation->prix_total ?? 0, 2) }} €
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @switch($reservation->statut)
                                        @case('confirmée')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Confirmé</span>
                                        @break
                                        @case('en attente')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">En attente</span>
                                        @break
                                        @case('annulée')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Annulé</span>
                                        @break
                                        @default
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">Statut inconnu</span>
                                        @endswitch
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <div class="flex space-x-3">
                                            <a href="" class="text-blue-600 hover:text-blue-900">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="" class="text-yellow-600 hover:text-yellow-900">
                                                <i class="fas fa-print"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>


                <!-- Latest Payments -->
                <div class="bg-white rounded-lg shadow-md">
                    <div class="flex items-center justify-between p-6 border-b worldcup-gradient">
                    <h2 class="text-white text-lg font-semibold flex items-center">
                            <i class="fas fa-euro-sign mr-2"></i>
                            Dernières paiements
                        </h2>
                        <!-- <a href="#" class="text-blue-600 hover:underline text-sm font-medium">Voir tous</a> -->
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gray-50">
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Réservation</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Méthode</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Montant</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">#P4721</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">#B2584</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Carte bancaire</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">01/03/2025</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">1 450 €</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Complété</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <div class="flex space-x-3">
                                            <a href="#" class="text-blue-600 hover:text-blue-900"><i class="fas fa-receipt"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">#P4720</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">#B2582</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">PayPal</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">28/02/2025</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">1 890 €</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Complété</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <div class="flex space-x-3">
                                            <a href="#" class="text-blue-600 hover:text-blue-900"><i class="fas fa-receipt"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">#P4719</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">#B2583</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Virement bancaire</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">28/02/2025</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">480 €</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">En attente</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <div class="flex space-x-3">
                                            <a href="#" class="text-blue-600 hover:text-blue-900"><i class="fas fa-eye"></i></a>
                                            <a href="#" class="text-green-600 hover:text-green-900"><i class="fas fa-check"></i></a>
                                            <a href="#" class="text-red-600 hover:text-red-900"><i class="fas fa-times"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

</html>