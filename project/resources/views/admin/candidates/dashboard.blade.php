{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}
<!-- resources/views/admin/dashboard.blade.php -->
@extends('layouts.admin')

@section('title', 'Tableau de bord')

@section('content')
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Tableau de bord</h2>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Candidats -->
        <div class="bg-white rounded-md shadow-md p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-600 bg-opacity-75 text-white mr-4">
                    <i class="fas fa-users text-2xl"></i>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Total Candidats</p>
                    <p class="text-2xl font-semibold text-gray-800">{{ $totalCandidates ?? '' }}</p>
                </div>
            </div>
            <div class="mt-6">
                <a href="{{ route('admin.candidates.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Voir tous les candidats</a>
            </div>
        </div>
        
        <!-- Quiz Complétés -->
        <div class="bg-white rounded-md shadow-md p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-600 bg-opacity-75 text-white mr-4">
                    <i class="fas fa-clipboard-check text-2xl"></i>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Quiz Complétés</p>
                    <p class="text-2xl font-semibold text-gray-800">{{ $completedQuizzes }}</p>
                </div>
            </div>
            <div class="mt-6">
                <a href="{{ route('admin.quizzes.results') }}" class="text-green-600 hover:text-green-800 text-sm font-medium">Voir les résultats</a>
            </div>
        </div>
        
        <!-- Tests Présentiels -->
        <div class="bg-white rounded-md shadow-md p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-600 bg-opacity-75 text-white mr-4">
                    <i class="fas fa-calendar-check text-2xl"></i>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Tests Présentiels</p>
                    <p class="text-2xl font-semibold text-gray-800">{{ $scheduledTests }}</p>
                </div>
            </div>
            <div class="mt-6">
                <a href="{{ route('admin.tests.index') }}" class="text-purple-600 hover:text-purple-800 text-sm font-medium">Voir le planning</a>
            </div>
        </div>
        
        <!-- Candidats Acceptés -->
        <div class="bg-white rounded-md shadow-md p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-600 bg-opacity-75 text-white mr-4">
                    <i class="fas fa-user-check text-2xl"></i>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Candidats Acceptés</p>
                    <p class="text-2xl font-semibold text-gray-800">{{ $acceptedCandidates }}</p>
                </div>
            </div>
            <div class="mt-6">
                <a href="{{ route('admin.candidates.accepted') }}" class="text-yellow-600 hover:text-yellow-800 text-sm font-medium">Voir les acceptés</a>
            </div>
        </div>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <!-- Récentes Candidatures -->
        <div class="bg-white rounded-md shadow-md">
            <div class="px-6 py-4 border-b">
                <h3 class="text-lg font-semibold text-gray-800">Candidatures Récentes</h3>
            </div>
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="text-left text-xs font-semibold uppercase tracking-wide text-gray-500 bg-gray-100">
                                <th class="px-4 py-3">Nom</th>
                                <th class="px-4 py-3">Date</th>
                                <th class="px-4 py-3">Étape</th>
                                <th class="px-4 py-3">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($recentCandidates as $candidate)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3">{{ $candidate->first_name }} {{ $candidate->last_name }}</td>
                                    <td class="px-4 py-3 text-sm">{{ $candidate->created_at->format('d/m/Y') }}</td>
                                    <td class="px-4 py-3">
                                        @if($candidate->application_step == 'document_verification')
                                            <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">Vérification</span>
                                        @elseif($candidate->application_step == 'quiz')
                                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Quiz</span>
                                        @elseif($candidate->application_step == 'scheduled_test')
                                            <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">Test Planifié</span>
                                        @elseif($candidate->application_step == 'completed')
                                            <span class="px-2 py-1 text-xs rounded-full bg-purple-100 text-purple-800">Terminé</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        <a href="{{ route('admin.candidates.show', $candidate->id) }}" class="text-blue-600 hover:text-blue-800">Détails</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-3 text-sm text-center text-gray-500">Aucune candidature récente</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    <a href="{{ route('admin.candidates.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Voir tous</a>
                </div>
            </div>
        </div>
        
        <!-- Tests planifiés -->
        <div class="bg-white rounded-md shadow-md">
            <div class="px-6 py-4 border-b">
                <h3 class="text-lg font-semibold text-gray-800">Tests Présentiels à Venir</h3>
            </div>
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="text-left text-xs font-semibold uppercase tracking-wide text-gray-500 bg-gray-100">
                                <th class="px-4 py-3">Date</th>
                                <th class="px-4 py-3">Heure</th>
                                <th class="px-4 py-3">Candidats</th>
                                <th class="px-4 py-3">Examinateur</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($upcomingTests as $test)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3">{{ \Carbon\Carbon::parse($test->date)->format('d/m/Y') }}</td>
                                    <td class="px-4 py-3 text-sm">{{ \Carbon\Carbon::parse($test->time)->format('H:i') }}</td>
                                    <td class="px-4 py-3 text-sm">{{ $test->candidates_count }}</td>
                                    <td class="px-4 py-3 text-sm">{{ $test->examiner->name }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-3 text-sm text-center text-gray-500">Aucun test planifié</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    <a href="{{ route('admin.tests.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Voir tous les tests</a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-md shadow-md">
        <div class="px-6 py-4 border-b">
            <h3 class="text-lg font-semibold text-gray-800">Statistiques</h3>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="border rounded-md p-4">
                    <h4 class="text-sm font-medium text-gray-500 mb-2">Taux de Conversion Quiz</h4>
                    <p class="text-xl font-bold">{{ number_format($quizConversionRate, 1) }}%</p>
                    <div class="w-full bg-gray-200 rounded-full h-2.5 mt-2">
                        <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $quizConversionRate }}%"></div>
                    </div>
                </div>
                
                <div class="border rounded-md p-4">
                    <h4 class="text-sm font-medium text-gray-500 mb-2">Taux d'Acceptation Final</h4>
                    <p class="text-xl font-bold">{{ number_format($finalAcceptanceRate, 1) }}%</p>
                    <div class="w-full bg-gray-200 rounded-full h-2.5 mt-2">
                        <div class="bg-green-600 h-2.5 rounded-full" style="width: {{ $finalAcceptanceRate }}%"></div>
                    </div>
                </div>
                
                <div class="border rounded-md p-4">
                    <h4 class="text-sm font-medium text-gray-500 mb-2">Score Moyen Quiz</h4>
                    <p class="text-xl font-bold">{{ number_format($averageQuizScore, 1) }}/100</p>
                    <div class="w-full bg-gray-200 rounded-full h-2.5 mt-2">
                        <div class="bg-yellow-600 h-2.5 rounded-full" style="width: {{ $averageQuizScore }}%"></div>
                    </div>
                </div>
                
                <div class="border rounded-md p-4">
                    <h4 class="text-sm font-medium text-gray-500 mb-2">Candidatures Mensuelles</h4>
                    <p class="text-xl font-bold">{{ $monthlyApplications }}</p>
                    <p class="text-sm text-gray-500 mt-2">
                        @if($applicationGrowth > 0)
                            <span class="text-green-600"><i class="fas fa-arrow-up"></i> {{ number_format($applicationGrowth, 1) }}%</span>
                        @elseif($applicationGrowth < 0)
                            <span class="text-red-600"><i class="fas fa-arrow-down"></i> {{ number_format(abs($applicationGrowth), 1) }}%</span>
                        @else
                            <span class="text-gray-600"><i class="fas fa-equals"></i> 0%</span>
                        @endif
                        depuis le mois dernier
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection