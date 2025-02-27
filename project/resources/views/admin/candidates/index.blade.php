<!-- resources/views/admin/candidates/index.blade.php -->
@extends('layouts.admin')

@section('title', 'Gestion des Candidats')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">Gestion des Candidats</h2>
        <div class="flex space-x-2">
            {{-- {{ route('admin.candidates.export') }} --}}
            <a href=""
                class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded">
                <i class="fas fa-file-excel mr-2"></i> Exporter
            </a>
        </div>
    </div>

    <!-- Filtres -->
    <div class="bg-white rounded-md shadow-md p-6 mb-6">
        {{-- {{ route('admin.candidates.index') }} --}}
        <form action="" method="GET"
            class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-4">
            <div>
                <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Recherche</label>
                <input type="text" name="search" id="search" value="{{ request('search') }}"
                    placeholder="Nom, email..."
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Étape</label>
                <select name="status" id="status"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Toutes</option>
                    <option value="document_verification"
                        {{ request('status') == 'document_verification' ? 'selected' : '' }}>Vérification des documents
                    </option>
                    <option value="quiz" {{ request('status') == 'quiz' ? 'selected' : '' }}>Quiz</option>
                    <option value="scheduled_test" {{ request('status') == 'scheduled_test' ? 'selected' : '' }}>Test
                        Programmé</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Terminé</option>
                </select>
            </div>

            <div>
                <label for="date_from" class="block text-sm font-medium text-gray-700 mb-1">Date début</label>
                <input type="date" name="date_from" id="date_from" value="{{ request('date_from') }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label for="date_to" class="block text-sm font-medium text-gray-700 mb-1">Date fin</label>
                <input type="date" name="date_to" id="date_to" value="{{ request('date_to') }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="flex items-end">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded">
                    <i class="fas fa-search mr-2"></i> Filtrer
                </button>
                {{-- {{ route('admin.candidates.index') }} --}}
                <a href=""
                    class="ml-2 bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded">
                    <i class="fas fa-times mr-2"></i> Réinitialiser
                </a>
            </div>
        </form>
    </div>

    <!-- Liste des candidats -->
    <div class="bg-white rounded-md shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Téléphone
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Étape
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Score
                            Quiz</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse(is_iterable($candidates ?? '') ? $candidates ?? '' : [] as $candidate)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $candidate->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 flex-shrink-0">
                                        <div
                                            class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-800 font-semibold">
                                            {{ substr($candidate->first_name, 0, 1) }}{{ substr($candidate->last_name, 0, 1) }}
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $candidate->first_name }}
                                            {{ $candidate->last_name }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $candidate->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $candidate->phone }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $candidate->created_at->format('d/m/Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($candidate->application_step == 'document_verification')
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Vérification</span>
                                @elseif($candidate->application_step == 'quiz')
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Quiz</span>
                                @elseif($candidate->application_step == 'scheduled_test')
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Test
                                        Planifié</span>
                                @elseif($candidate->application_step == 'completed')
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">Terminé</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                @if ($candidate->quiz_score)
                                    {{ $candidate->quiz_score }}/100
                                @else
                                    -
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('admin.candidates.show', $candidate->id) }}"
                                    class="text-blue-600 hover:text-blue-900 mr-3">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if ($candidate->application_step == 'document_verification')
                                    <a href="{{ route('admin.candidates.approve', $candidate->id) }}"
                                        class="text-green-600 hover:text-green-900 mr-3">
                                        <i class="fas fa-check"></i>
                                    </a>
                                @endif
                                @if ($candidate->application_step == 'scheduled_test')
                                    <a href="{{ route('admin.candidates.schedule', $candidate->id) }}"
                                        class="text-yellow-600 hover:text-yellow-900 mr-3">
                                        <i class="fas fa-calendar-alt"></i>
                                    </a>
                                @endif
                                <form action="{{ route('admin.candidates.destroy', $candidate->id) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900"
                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce candidat ?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">Aucun
                                candidat trouvé</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
            <div class="flex justify-between flex-col sm:flex-row items-center">
                <div class="mb-4 sm:mb-0">
                    <p class="text-sm text-gray-700">
                        Affichage de
                        {{-- {{ $candidates->firstItem() ?? 0 }} --}}
                        <span class="font-medium">123</span>
                        à
                        {{-- {{ $candidates->lastItem() ?? 0 }} --}}
                        <span class="font-medium">1234</span>
                        sur
                        {{-- {{ $candidates->total() }} --}}
                        <span class="font-medium">12345</span>
                        résultats
                    </p>
                </div>

                <div>
                  hello youcode   {{-- {{ $candidates->appends(request()->query())->links() }} --}}
                </div>
            </div>
        </div>
    </div>

    <!-- Légende des statuts -->
    <div class="mt-6 bg-white rounded-md shadow-md p-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Légende des étapes</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="flex items-center">
                <span
                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800 mr-2">Vérification</span>
                <span class="text-sm text-gray-700">Documents en attente de vérification</span>
            </div>
            <div class="flex items-center">
                <span
                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 mr-2">Quiz</span>
                <span class="text-sm text-gray-700">En attente de passage du quiz</span>
            </div>
            <div class="flex items-center">
                <span
                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800 mr-2">Test
                    Planifié</span>
                <span class="text-sm text-gray-700">Test présentiel planifié</span>
            </div>
            <div class="flex items-center">
                <span
                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800 mr-2">Terminé</span>
                <span class="text-sm text-gray-700">Processus de candidature terminé</span>
            </div>
        </div>
    </div>

    <!-- Statistiques rapides -->
    <div class="mt-6 bg-white rounded-md shadow-md p-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Statistiques des candidatures</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="border rounded-md p-4">
                <h4 class="text-sm font-medium text-gray-500 mb-2">Total</h4>
                {{-- {{ $candidates->total() }} --}}
                <p class="text-xl font-bold">113</p>
            </div>
            <div class="border rounded-md p-4">
                <h4 class="text-sm font-medium text-gray-500 mb-2">Cette semaine</h4>
                {{-- {{ $weeklyApplications ?? 0 }} --}}
                <p class="text-xl font-bold">114</p>
            </div>
            <div class="border rounded-md p-4">
                <h4 class="text-sm font-medium text-gray-500 mb-2">Score moyen (Quiz)</h4>
                {{-- {{ number_format($averageQuizScore ?? 0, 1) }} --}}
                <p class="text-xl font-bold">34/100</p>
            </div>
            <div class="border rounded-md p-4">
                <h4 class="text-sm font-medium text-gray-500 mb-2">Taux de conversion</h4>
                {{-- {{ number_format($conversionRate ?? 0, 1) }} --}}
                <p class="text-xl font-bold">123%</p>
            </div>
        </div>
    </div>

    <!-- Actions groupées -->
    <div class="mt-6 bg-white rounded-md shadow-md p-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Actions groupées</h3>
        <div class="flex flex-wrap gap-4">
            {{-- {{ route('admin.candidates.verify-all') }} --}}
            <a href=""
                class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded">
                <i class="fas fa-check-double mr-2"></i> Valider tous les documents en attente
            </a>
            {{-- {{ route('admin.candidates.send-reminders') }} --}}
            <a href=""
                class="bg-yellow-600 hover:bg-yellow-700 text-white font-medium py-2 px-4 rounded">
                <i class="fas fa-bell mr-2"></i> Envoyer des rappels
            </a>
            {{-- {{ route('admin.candidates.schedule-bulk') }} --}}
            <a href=""
                class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded">
                <i class="fas fa-calendar-plus mr-2"></i> Planifier tests par lot
            </a>
        </div>
    </div>

    <!-- Guide d'utilisation -->
    <div x-data="{ open: false }" class="mt-6 bg-white rounded-md shadow-md overflow-hidden">
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200 flex justify-between items-center cursor-pointer"
            @click="open = !open">
            <h3 class="text-lg font-medium text-gray-900">Guide d'utilisation rapide</h3>
            <i class="fas" :class="open ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
        </div>
        <div x-show="open" class="px-6 py-4">
            <div class="prose max-w-none">
                <p>Cette page vous permet de gérer l'ensemble des candidatures pour YouCode. Voici quelques fonctionnalités
                    clés :</p>
                <ul>
                    <li><strong>Filtres</strong> : Affinez la liste des candidats par nom, email, étape du processus ou
                        période.</li>
                    <li><strong>Actions individuelles</strong> : Pour chaque candidat, vous pouvez :
                        <ul>
                            <li><i class="fas fa-eye"></i> Voir les détails complets de la candidature</li>
                            <li><i class="fas fa-check"></i> Approuver les documents (si en attente de vérification)</li>
                            <li><i class="fas fa-calendar-alt"></i> Planifier un test présentiel (si en attente de
                                planification)</li>
                            <li><i class="fas fa-trash"></i> Supprimer la candidature (action irréversible)</li>
                        </ul>
                    </li>
                    <li><strong>Actions groupées</strong> : Effectuez des actions sur plusieurs candidats à la fois, comme
                        valider tous les documents en attente ou envoyer des rappels.</li>
                    <li><strong>Exportation</strong> : Exportez la liste filtrée des candidats au format Excel pour des
                        analyses plus poussées.</li>
                </ul>
                <p>Pour plus d'informations, consultez la documentation complète dans la section <a
                    {{-- {{ route('admin.documentation') }} --}}
                        href=""
                        class="text-blue-600 hover:text-blue-800">Documentation</a>.</p>
            </div>
        </div>
    </div>

    @section('scripts')
        <script>
            // Pour les confirmations de suppression
            document.addEventListener('DOMContentLoaded', function() {
                const deleteButtons = document.querySelectorAll('button[onclick*="confirm"]');
                deleteButtons.forEach(button => {
                    button.addEventListener('click', function(e) {
                        if (!confirm(this.getAttribute('onclick').split('\'')[1])) {
                            e.preventDefault();
                        }
                    });
                });
            });
        </script>
    @endsection
@endsection
