<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Groupes - Test CME</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

    <div class="container mx-auto my-8">
        <h1 class="text-3xl font-semibold mb-6">Gestion des Groupes pour le Test CME</h1>

        <!-- Sessions CME -->
        <div class="grid grid-cols-2 gap-6">
            <!-- Session Matinale -->
            <div class="bg-white p-4 shadow-md rounded-lg">
                <h2 class="text-2xl font-semibold mb-4">Session Matinale (12 Candidats)</h2>
                <table class="min-w-full bg-gray-50 border border-gray-200">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="px-4 py-2">Groupe</th>
                            <th class="px-4 py-2">Candidat</th>
                            <th class="px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($matinaleGroups ?? [] as $group)
                        <tr>
                            <td class="px-4 py-2">{{ $group->name }}</td>
                            <td class="px-4 py-2">
                                @foreach ($group->candidates as $candidate)
                                <p>{{ $candidate->name }}</p>
                                @endforeach
                            </td>
                            <td class="px-4 py-2">
                                <button class="text-blue-500 hover:underline" onclick="openEditGroupModal('{{ $group->id }}')">Modifier</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Session Après-midi -->
            <div class="bg-white p-4 shadow-md rounded-lg">
                <h2 class="text-2xl font-semibold mb-4">Session Après-midi (12 Candidats)</h2>
                <table class="min-w-full bg-gray-50 border border-gray-200">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="px-4 py-2">Groupe</th>
                            <th class="px-4 py-2">Candidat</th>
                            <th class="px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($apresMidiGroups ?? [] as $group)
                        <tr>
                            <td class="px-4 py-2">{{ $group->name }}</td>
                            <td class="px-4 py-2">
                                @foreach ($group->candidates as $candidate)
                                <p>{{ $candidate->name }}</p>
                                @endforeach
                            </td>
                            <td class="px-4 py-2">
                                <button class="text-blue-500 hover:underline" onclick="openEditGroupModal('{{ $group->id }}')">Modifier</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal de modification de groupe -->
        <div id="edit-group-modal" class="fixed inset-0 flex justify-center items-center bg-gray-800 bg-opacity-50 hidden">
            <div class="bg-white p-6 rounded-lg w-1/3">
                <h2 class="text-xl font-semibold mb-4">Modifier le Groupe</h2>
                {{-- {{ route('update.group') }} --}}
                <form action="" method="POST">
                    @csrf
                    <input type="hidden" id="group_id" name="group_id">
                    <div class="mb-4">
                        <label for="new_candidates" class="block text-sm font-medium text-gray-700">Ajouter/Supprimer des Candidats</label>
                        <select id="new_candidates" name="new_candidates[]" class="w-full p-2 border border-gray-300 rounded-md" multiple>
                            @foreach ($allCandidates ?? [] as $candidate)
                                <option value="{{ $candidate->id }}">{{ $candidate->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Sauvegarder</button>
                        <button type="button" class="ml-2 bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600" onclick="closeEditGroupModal()">Annuler</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <script>
        // Fonction pour ouvrir le modal de modification de groupe
        function openEditGroupModal(groupId) {
            document.getElementById('group_id').value = groupId;
            document.getElementById('edit-group-modal').classList.remove('hidden');
        }

        // Fonction pour fermer le modal de modification de groupe
        function closeEditGroupModal() {
            document.getElementById('edit-group-modal').classList.add('hidden');
        }
    </script>

</body>
</html>
