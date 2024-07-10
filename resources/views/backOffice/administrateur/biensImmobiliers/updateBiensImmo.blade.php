<x-app-layout>
    @include('include.sidebar')
    <div class="p-6 bg-gray-100">
        <h1 class="text-3xl font-semibold mb-6">Modifier un Bien Immobilier</h1>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <form action="{{ route('adminBien.update', $biens->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="titre" class="block text-gray-700 font-bold mb-2">Titre:</label>
                    <input type="text" name="titre" id="titre" class="w-full p-2 border border-gray-300 rounded" value="{{ $biens->titre }}" required>
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-gray-700 font-bold mb-2">Description:</label>
                    <textarea name="description" id="description" class="w-full p-2 border border-gray-300 rounded" required>{{ $biens->description }}</textarea>
                </div>
                <div class="mb-4">
                    <label for="adresse" class="block text-gray-700 font-bold mb-2">Adresse:</label>
                    <input type="text" name="adresse" id="adresse" class="w-full p-2 border border-gray-300 rounded" value="{{ $biens->adresse }}" required>
                </div>
                <div class="mb-4">
                    <label for="ville" class="block text-gray-700 font-bold mb-2">Ville:</label>
                    <select name="ville" id="ville" class="w-full p-2 border border-gray-300 rounded" required>
                        <option value="Paris" {{ $biens->ville == 'Paris' ? 'selected' : '' }}>Paris</option>
                        <option value="Marseille" {{ $biens->ville == 'Marseille' ? 'selected' : '' }}>Marseille</option>
                        <option value="Lille" {{ $biens->ville == 'Lille' ? 'selected' : '' }}>Lille</option>
                        <option value="Lyon" {{ $biens->ville == 'Lyon' ? 'selected' : '' }}>Lyon</option>
                        <option value="Bordeaux" {{ $biens->ville == 'Bordeaux' ? 'selected' : '' }}>Bordeaux</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="prix" class="block text-gray-700 font-bold mb-2">Prix:</label>
                    <input type="number" name="prix" id="prix" class="w-full p-2 border border-gray-300 rounded" value="{{ $biens->prix }}" required>
                </div>
                <div class="mb-4">
                    <label for="nombre_de_chambres" class="block text-gray-700 font-bold mb-2">Nombre de Chambres:</label>
                    <input type="number" name="nombre_de_chambres" id="nombre_de_chambres" class="w-full p-2 border border-gray-300 rounded" value="{{ $biens->nombre_de_chambres }}" required>
                </div>
                <div class="mb-4">
                    <label for="nombre_de_salles_de_bain" class="block text-gray-700 font-bold mb-2">Nombre de Salles de Bain:</label>
                    <input type="number" name="nombre_de_salles_de_bain" id="nombre_de_salles_de_bain" class="w-full p-2 border border-gray-300 rounded" value="{{ $biens->nombre_de_salles_de_bain }}" required>
                </div>
                <div class="mb-4">
                    <label for="superficie" class="block text-gray-700 font-bold mb-2">Superficie:</label>
                    <input type="number" name="superficie" id="superficie" class="w-full p-2 border border-gray-300 rounded" value="{{ $biens->superficie }}" required>
                </div>
                <div class="mb-4">
                    <label for="type_de_bien" class="block text-gray-700 font-bold mb-2">Type de Bien:</label>
                    <select name="type_de_bien" id="type_de_bien" class="w-full p-2 border border-gray-300 rounded" required>
                        <option value="Appartement" {{ $biens->type_de_bien == 'Appartement' ? 'selected' : '' }}>Appartement</option>
                        <option value="Maison" {{ $biens->type_de_bien == 'Maison' ? 'selected' : '' }}>Maison</option>
                        <option value="Gîte" {{ $biens->type_de_bien == 'Gîte' ? 'selected' : '' }}>Gîte</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="nombre_de_lits" class="block text-gray-700 font-bold mb-2">Nombre de Lits:</label>
                    <input type="number" name="nombre_de_lits" id="nombre_de_lits" class="w-full p-2 border border-gray-300 rounded" value="{{ $biens->nombre_de_lits }}" required>
                </div>
                <div class="mb-4">
                    <label for="capacite_max" class="block text-gray-700 font-bold mb-2">Capacité Max:</label>
                    <input type="number" name="capacite_max" id="capacite_max" class="w-full p-2 border border-gray-300 rounded" value="{{ $biens->capacite_max }}" required>
                </div>
                <div class="mb-4">
                    <label for="wifi" class="block text-gray-700 font-bold mb-2">Wi-Fi:</label>
                    <select name="wifi" id="wifi" class="w-full p-2 border border-gray-300 rounded" required>
                        <option value="1" {{ $biens->wifi ? 'selected' : '' }}>Oui</option>
                        <option value="0" {{ !$biens->wifi ? 'selected' : '' }}>Non</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="parking" class="block text-gray-700 font-bold mb-2">Parking:</label>
                    <select name="parking" id="parking" class="w-full p-2 border border-gray-300 rounded" required>
                        <option value="1" {{ $biens->parking ? 'selected' : '' }}>Oui</option>
                        <option value="0" {{ !$biens->parking ? 'selected' : '' }}>Non</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="climatisation" class="block text-gray-700 font-bold mb-2">Climatisation:</label>
                    <select name="climatisation" id="climatisation" class="w-full p-2 border border-gray-300 rounded" required>
                        <option value="1" {{ $biens->climatisation ? 'selected' : '' }}>Oui</option>
                        <option value="0" {{ !$biens->climatisation ? 'selected' : '' }}>Non</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="chauffage" class="block text-gray-700 font-bold mb-2">Chauffage:</label>
                    <select name="chauffage" id="chauffage" class="w-full p-2 border border-gray-300 rounded" required>
                        <option value="1" {{ $biens->chauffage ? 'selected' : '' }}>Oui</option>
                        <option value="0" {{ !$biens->chauffage ? 'selected' : '' }}>Non</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="cuisine" class="block text-gray-700 font-bold mb-2">Cuisine:</label>
                    <select name="cuisine" id="cuisine" class="w-full p-2 border border-gray-300 rounded" required>
                        <option value="1" {{ $biens->cuisine ? 'selected' : '' }}>Oui</option>
                        <option value="0" {{ !$biens->cuisine ? 'selected' : '' }}>Non</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="animaux_acceptes" class="block text-gray-700 font-bold mb-2">Animaux Acceptés:</label>
                    <select name="animaux_acceptes" id="animaux_acceptes" class="w-full p-2 border border-gray-300 rounded" required>
                        <option value="1" {{ $biens->animaux_acceptes ? 'selected' : '' }}>Oui</option>
                        <option value="0" {{ !$biens->animaux_acceptes ? 'selected' : '' }}>Non</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="statut" class="block text-gray-700 font-bold mb-2">Statut:</label>
                    <select name="statut" id="statut" class="w-full p-2 border border-gray-300 rounded" required>
                        <option value="0" {{ $biens->statut == 0 ? 'selected' : '' }}>En Attente</option>
                        <option value="1" {{ $biens->statut == 1 ? 'selected' : '' }}>Accepté</option>
                        <option value="2" {{ $biens->statut == 2 ? 'selected' : '' }}>Refusé</option>
                    </select>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Modifier</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
