<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interface d'Assignation</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

    <div class="container mx-auto my-8">
        <h1 class="text-3xl font-semibold mb-6">Gestion des Assignations des Tests</h1>

        <!-- Table des Assignations -->
        <table class="min-w-full bg-white shadow-md rounded-lg">
            <thead>
                <tr class="bg-gray-200">
                    <th class="px-6 py-3 text-left">Candidat</th>
                    <th class="px-6 py-3 text-left">Type de Test</th>
                    <th class="px-6 py-3 text-left">Date et Heure</th>
                    <th class="px-6 py-3 text-left">Personnel Assigné</th>
                    <th class="px-6 py-3 text-left">Critères d'Assignation</th>
                    <th class="px-6 py-3 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($assignations ?? [] as $assignation)
                <tr>
                    <td class="px-6 py-4">{{ $assignation->candidat->name }}</td>
                    <td class="px-6 py-4">{{ $assignation->test_type }}</td>
                    <td class="px-6 py-4">{{ $assignation->date_heure }}</td>
                    <td class="px-6 py-4">{{ $assignation->personnel->name }}</td>
                    <td class="px-6 py-4">
                        <button class="text-blue-500 hover:underline" onclick="toggleDetails({{ $assignation->id }})">
                            Voir les critères
                        </button>
                        <div id="details-{{ $assignation->id }}" class="hidden mt-2">
                            <p><strong>Disponibilité du personnel :</strong> {{ $assignation->personnel_availability }}</p>
                            <p><strong>Plage horaire :</strong> {{ $assignation->time_slot }}</p>
                            <p><strong>Conflits éventuels :</strong> {{ $assignation->conflicts }}</p>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <button class="bg-yellow-500 text-white px-4 py-2 rounded-md hover:bg-yellow-600" onclick="openEditModal({{ $assignation->id }})">
                            Modifier
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Modal de modification -->
        <div id="edit-modal" class="fixed inset-0 flex justify-center items-center bg-gray-800 bg-opacity-50 hidden">
            <div class="bg-white p-6 rounded-lg w-1/3">
                <h2 class="text-xl font-semibold mb-4">Modifier l'Assignation</h2>
                {{-- {{ route('update.assignation') }} --}}
                <form action="" method="POST">
                    @csrf
                    <input type="hidden" id="assignation_id" name="assignation_id">
                    <div class="mb-4">
                        <label for="personnel" class="block text-sm font-medium text-gray-700">Personnel Assigné</label>
                        <select id="personnel" name="personnel" class="w-full p-2 border border-gray-300 rounded-md">
                            @foreach ($personnels ?? [] as $personnel)
                                <option value="{{ $personnel->id }}">{{ $personnel->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="date_heure" class="block text-sm font-medium text-gray-700">Date et Heure</label>
                        <input type="datetime-local" id="date_heure" name="date_heure" class="w-full p-2 border border-gray-300 rounded-md">
                    </div>
                    <div class="mb-4">
                        <label for="test_type" class="block text-sm font-medium text-gray-700">Type de Test</label>
                        <select id="test_type" name="test_type" class="w-full p-2 border border-gray-300 rounded-md">
                            <option value="CME">Test CME</option>
                            <option value="Technique">Test Technique</option>
                            <option value="Administratif">Test Administratif</option>
                        </select>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Sauvegarder</button>
                        <button type="button" class="ml-2 bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600" onclick="closeEditModal()">Annuler</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Fonction pour afficher/masquer les détails des critères
        function toggleDetails(id) {
            const detailsDiv = document.getElementById('details-' + id);
            detailsDiv.classList.toggle('hidden');
        }

        // Fonction pour ouvrir le modal de modification
        function openEditModal(assignationId) {
            document.getElementById('assignation_id').value = assignationId;
            document.getElementById('edit-modal').classList.remove('hidden');
        }

        // Fonction pour fermer le modal de modification
        function closeEditModal() {
            document.getElementById('edit-modal').classList.add('hidden');
        }
    </script>

</body>
</html>
