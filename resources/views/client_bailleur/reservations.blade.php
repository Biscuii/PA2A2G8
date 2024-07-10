<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold mb-4">Mes Biens Réservés</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($reservations as $reservation)
            <div class="bg-white shadow-md rounded-lg p-4">
                <div class="border-b-2 border-indigo-500 mb-4">
                    <h2 class="text-xl font-semibold text-indigo-600">{{ $reservation->bienImmobilier->titre }}</h2>
                </div>
                <p class="mb-2">{{ $reservation->bienImmobilier->description }}</p>
                <p class="mb-2"><strong>Adresse :</strong> {{ $reservation->bienImmobilier->adresse }}</p>
                <p class="mb-2"><strong>Prix :</strong> {{ $reservation->bienImmobilier->prix }} € / nuit</p>
                <p class="mb-2"><strong>Date de début :</strong> {{ $reservation->date_debut }}</p>
                <p class="mb-2"><strong>Date de fin :</strong> {{ $reservation->date_fin }}</p>
                <p class="mb-2"><strong>Prix total :</strong> {{ $reservation->prix_total }} €</p>
                <p class="mb-2"><strong>Statut :</strong> {{ ucfirst($reservation->statut) }}</p>

                <div class="flex space-x-4">
                    @if($reservation->statut == 'En Attente')
                    <form action="{{ route('client_bailleur.acceptReservation', $reservation->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment accepter cette réservation ?');">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            Accepter
                        </button>
                    </form>
                    @endif
                    <form action="{{ route('client_bailleur.cancelReservation', $reservation->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment annuler cette réservation ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                            Annuler
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
