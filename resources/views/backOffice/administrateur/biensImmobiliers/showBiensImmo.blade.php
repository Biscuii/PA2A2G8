<x-app-layout>
    @include('include.sidebar')
    <div class="p-6 bg-gray-100">
        <h1 class="text-3xl font-semibold mb-6">{{ $bien->titre }}</h1>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="mb-4">
                <p><strong>Adresse:</strong> {{ $bien->adresse }}</p>
                <p><strong>Ville:</strong> {{ $bien->ville }}</p>
                <p><strong>Prix par nuit:</strong> {{ $bien->prix }} €</p>
                <p><strong>Type:</strong> {{ $bien->type_de_bien }}</p>
                <p><strong>Capacité max:</strong> {{ $bien->capacite_max }}</p>
                <p><strong>Nombre de chambres:</strong> {{ $bien->nombre_de_chambres }}</p>
                <p><strong>Nombre de salles de bain:</strong> {{ $bien->nombre_de_salles_de_bain }}</p>
                <p><strong>Superficie:</strong> {{ $bien->superficie }} m²</p>
                <p><strong>Description:</strong> {{ $bien->description }}</p>
                <p><strong>WiFi:</strong> {{ $bien->wifi ? 'Oui' : 'Non' }}</p>
                <p><strong>Parking:</strong> {{ $bien->parking ? 'Oui' : 'Non' }}</p>
                <p><strong>Climatisation:</strong> {{ $bien->climatisation ? 'Oui' : 'Non' }}</p>
                <p><strong>Chauffage:</strong> {{ $bien->chauffage ? 'Oui' : 'Non' }}</p>
                <p><strong>Cuisine:</strong> {{ $bien->cuisine ? 'Oui' : 'Non' }}</p>
                <p><strong>Animaux acceptés:</strong> {{ $bien->animaux_acceptes ? 'Oui' : 'Non' }}</p>
                <p><strong>Statut:</strong> {{ $bien->statut }}</p>
                @if ($bien->statut == 'Refusé')
                <p><strong>Message de refus:</strong> {{ $bien->message_refus }}</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
