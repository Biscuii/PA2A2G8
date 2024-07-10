<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold mb-4">Mes Réservations</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($reservations as $reservation)
            <div class="bg-white shadow-md rounded-lg p-4">
                <div class="border-b-2 border-indigo-500 mb-4">
                    <h2 class="text-xl font-semibold text-indigo-600">{{ $reservation->bienImmobilier->titre }}</h2>
                </div>
                <p class="mb-2">{{ $reservation->bienImmobilier->description }}</p>
                <p class="mb-2"><strong>Adresse :</strong> {{ $reservation->bienImmobilier->adresse }}</p>
                <p class="mb-2"><strong>Prix :</strong> {{ $reservation->bienImmobilier->prix }} € / nuit</p>
                <p class="mb-2"><strong>Type de bien :</strong> {{ $reservation->bienImmobilier->type_de_bien }}</p>
                <p class="mb-2"><strong>Nombre de chambres :</strong> {{ $reservation->bienImmobilier->nombre_de_chambres }}</p>
                <p class="mb-2"><strong>Nombre de lits :</strong> {{ $reservation->bienImmobilier->nombre_de_lits }}</p>
                <p class="mb-2"><strong>Capacité maximale :</strong> {{ $reservation->bienImmobilier->capacite_max }}</p>
                <p class="mb-2"><strong>Nombre de salles de bain :</strong> {{ $reservation->bienImmobilier->nombre_de_salles_de_bain }}</p>

                @if($reservation->bienImmobilier->wifi)
                <p class="mb-2"><strong>WiFi :</strong> Disponible</p>
                @endif
                @if($reservation->bienImmobilier->parking)
                <p class="mb-2"><strong>Parking :</strong> Disponible</p>
                @endif
                @if($reservation->bienImmobilier->climatisation)
                <p class="mb-2"><strong>Climatisation :</strong> Disponible</p>
                @endif
                @if($reservation->bienImmobilier->chauffage)
                <p class="mb-2"><strong>Chauffage :</strong> Disponible</p>
                @endif
                @if($reservation->bienImmobilier->cuisine)
                <p class="mb-2"><strong>Cuisine :</strong> Disponible</p>
                @endif
                @if($reservation->bienImmobilier->animaux_acceptes)
                <p class="mb-2"><strong>Animaux acceptés :</strong> Oui</p>
                @endif

                <p class="mb-2"><strong>Date de début :</strong> {{ $reservation->date_debut }}</p>
                <p class="mb-2"><strong>Date de fin :</strong> {{ $reservation->date_fin }}</p>
                <p class="mb-2"><strong>Prix total :</strong> {{ $reservation->total_prix }} €</p>
                <p class="mb-2"><strong>Statut :</strong> {{ ucfirst($reservation->statut) }}</p>

                @if($reservation->status != 'cancelled')
                <form action="{{ route('voyageur.cancelReservation', $reservation->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment annuler cette réservation ?');">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                        Annuler
                    </button>
                </form>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
