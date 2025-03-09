<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TouriStay 2030 - Paiement</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://js.stripe.com/v3/"></script>
    <style>
        .worldcup-gradient {
            background: linear-gradient(135deg, #862633 0%, #009A44 100%);
        }

        .payment-card {
            transition: all 0.3s ease;
        }

        .payment-card:hover {
            transform: translateY(-5px);
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center">
                    <a href="#" class="flex items-center text-2xl font-semibold">
                        <i class="fas fa-futbol text-[#862633] text-2xl mr-2"></i>
                        TouriStay 2030
                    </a>
                </div>

                <div class="flex items-center space-x-4">
                    <button class="text-[#862633] hover:text-[#009A44] transition-colors duration-300">
                        <i class="far fa-bell text-xl"></i>
                    </button>
                    <button class="text-[#862633] hover:text-[#009A44] transition-colors duration-300">
                        <i class="far fa-user-circle text-xl"></i>
                    </button>
                    <a href="#" class="worldcup-gradient text-white px-4 py-2 rounded-lg font-medium transition duration-300 hover:opacity-90">
                        <i class="fas fa-sign-out-alt mr-2"></i>
                        Déconnexion
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden">
            <!-- Header -->
            <div class="worldcup-gradient p-6 text-white">
                <h1 class="text-2xl font-bold flex items-center">
                    <i class="fas fa-credit-card mr-3"></i>
                    Finalisation de la Réservation
                </h1>
                <p class="text-white/80 mt-2">
                    Coupe du Monde 2030 - Paiement Sécurisé
                </p>
            </div>

            <div class="p-6">
                <!-- Alert -->
                <div class="bg-[#862633]/10 border-l-4 border-[#862633] p-4 mb-6">
                    <p class="text-[#862633] flex items-center">
                        <i class="fas fa-info-circle mr-2"></i>
                        Veuillez procéder au paiement pour finaliser votre réservation
                    </p>
                </div>
                <!-- Détails de la réservation -->
                <div class="grid md:grid-cols-2 gap-6">
                    <!-- Détails -->
                    <div class="bg-white rounded-xl shadow-md p-6 payment-card">
                        <h2 class="text-xl font-semibold mb-4 text-[#862633] flex items-center">
                            <i class="fas fa-info-circle mr-2"></i>
                            Détails de la Réservation
                        </h2>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                <span class="text-gray-600 flex items-center">
                                    <i class="fas fa-home text-[#009A44] mr-2"></i>
                                    Hébergement:
                                </span>
                                <span class="font-medium text-[#862633]">Appartement Vue Mer</span>
                            </div>
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                <span class="text-gray-600 flex items-center">
                                    <i class="fas fa-calendar-check text-[#009A44] mr-2"></i>
                                    Date d'arrivée:
                                </span>
                                <span class="font-medium text-[#862633]">15 Juillet 2025</span>
                            </div>
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                <span class="text-gray-600 flex items-center">
                                    <i class="fas fa-calendar-times text-[#009A44] mr-2"></i>
                                    Date de départ:
                                </span>
                                <span class="font-medium text-[#862633]">20 Juillet 2025</span>
                            </div>
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                <span class="text-gray-600 flex items-center">
                                    <i class="fas fa-moon text-[#009A44] mr-2"></i>
                                    Nombre de nuits:
                                </span>
                                <span class="font-medium text-[#862633]">5 nuits</span>
                            </div>
                        </div>
                    </div>

                    <!-- Récapitulatif -->
                    <div class="bg-white rounded-xl shadow-md p-6 payment-card">
                        <h2 class="text-xl font-semibold mb-4 text-[#009A44] flex items-center">
                            <i class="fas fa-receipt mr-2"></i>
                            Récapitulatif
                        </h2>
                        <div class="bg-gray-50 p-6 rounded-xl">
                            <div class="space-y-4">
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">Prix par nuit:</span>
                                    <span class="font-medium text-[#862633]">100 €</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">Nombre de nuits:</span>
                                    <span class="font-medium text-[#862633]">5</span>
                                </div>
                                <hr class="border-gray-200">
                                <div class="flex justify-between items-center text-lg font-bold">
                                    <span class="text-[#009A44]">Total:</span>
                                    <span class="text-[#862633]">500 €</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Formulaire de paiement -->
                <form id="payment-form" action="{{ route('paiement.process') }}" method="POST" class="mt-8">
                    @csrf
                    <div class="bg-white rounded-xl shadow-md p-6 mb-6">
                        <h2 class="text-xl font-semibold mb-4 text-[#862633] flex items-center">
                            <i class="fas fa-lock mr-2"></i>
                            Informations de paiement
                        </h2>
                        <div id="card-element" class="p-4 border border-gray-200 rounded-lg"></div>
                        <input type="hidden" name="stripeToken" id="stripe-token">
                        <div id="card-errors" class="mt-2 text-[#862633] text-sm"></div>
                    </div>

                    <!-- Boutons d'action -->
                    <div class="flex flex-col sm:flex-row justify-center items-center gap-4">
                        <button type="submit" id="submit-button"
                            class="worldcup-gradient text-white px-8 py-3 rounded-lg font-medium text-lg transition duration-300 hover:opacity-90 w-full sm:w-auto flex items-center justify-center">
                            <i class="fas fa-lock mr-2"></i>
                            Procéder au Paiement
                        </button>

                        <a href="{{ route('invoice.download', ['id' => $reservation->id]) }}"
                            class="worldcup-gradient text-white px-8 py-3 rounded-lg font-medium text-lg transition duration-300 hover:opacity-90 w-full sm:w-auto flex items-center justify-center">
                            <i class="fas fa-file-pdf mr-2"></i>
                            Télécharger la Facture
                        </a>
                    </div>
                </form>

                <!-- Info supplémentaire -->
                <div class="mt-6 text-center text-sm text-gray-500">
                    <p class="flex items-center justify-center">
                        <i class="fas fa-shield-alt text-[#009A44] mr-2"></i>
                        Paiement sécurisé - Toutes vos données sont chiffrées
                    </p>
                </div>
            </div>
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


    <!-- Scripts -->
    <script>
        var stripe = Stripe('{{ env("STRIPE_KEY") }}');
        var elements = stripe.elements();

        var cardElement = elements.create('card');
        cardElement.mount('#card-element');

        var form = document.getElementById('payment-form');
        var submitButton = document.getElementById('submit-button');
        var cardErrors = document.getElementById('card-errors');
        var tokenInput = document.getElementById('stripe-token');

        form.addEventListener('submit', async function(event) {
            event.preventDefault();
            submitButton.disabled = true;

            const {
                token,
                error
            } = await stripe.createToken(cardElement);


            if (error) {
                cardErrors.textContent = error.message;
                submitButton.disabled = false;
            } else {
                console.log(token.id);

                tokenInput.value = token.id; // Set the token in the hidden input
                form.submit(); // Submit the form with the token
            }
        });
    </script>
</body>

</html>