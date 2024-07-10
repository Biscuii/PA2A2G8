<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold mb-4">{{ $bien->titre }}</h1>

        <div class="bg-white shadow-md rounded-lg p-4">
            <p>{{ $bien->description }}</p>
            <p><strong>Adresse :</strong> {{ $bien->adresse }}</p>
            <p><strong>Prix :</strong> {{ $bien->prix }} €</p>
            <p><strong>Type de bien :</strong> {{ $bien->type_de_bien }}</p>
            <p><strong>Nombre de chambres :</strong> {{ $bien->nombre_de_chambres }}</p>
            <p><strong>Nombre de lits :</strong> {{ $bien->nombre_de_lits }}</p>
            <p><strong>Capacité maximale :</strong> {{ $bien->capacite_max }}</p>
            <p><strong>Nombre de salles de bain :</strong> {{ $bien->nombre_de_salles_de_bain }}</p>

            @if($bien->wifi)
            <p><strong>WiFi :</strong> Disponible</p>
            @endif
            @if($bien->parking)
            <p><strong>Parking :</strong> Disponible</p>
            @endif
            @if($bien->climatisation)
            <p><strong>Climatisation :</strong> Disponible</p>
            @endif
            @if($bien->chauffage)
            <p><strong>Chauffage :</strong> Disponible</p>
            @endif
            @if($bien->cuisine)
            <p><strong>Cuisine :</strong> Disponible</p>
            @endif
            @if($bien->animaux_acceptes)
            <p><strong>Animaux acceptés :</strong> Oui</p>
            @endif

            <form method="POST" action="{{ route('voyageur.reserve', $bien->id) }}">
                @csrf
                <input type="hidden" name="date_debut" value="{{ session('date_debut') }}">
                <input type="hidden" name="date_fin" value="{{ session('date_fin') }}">
                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md">Réserver du {{ session('date_debut') }} au {{ session('date_fin') }}</button>
            </form>
        </div>
    </div>
</x-app-layout>
