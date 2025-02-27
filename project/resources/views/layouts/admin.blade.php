<!-- resources/views/layouts/admin.blade.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - YouCode Admin</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Tailwind CSS -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="{{ mix('js/app.js') }}"></script>
    
    
    
    <!-- AlpineJS -->
    
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    
    @yield('styles')
</head>
<body class="bg-gray-100 font-sans">
    <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-100">
        <!-- Sidebar -->
        <div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false" class="fixed z-20 inset-0 bg-black opacity-50 transition-opacity lg:hidden"></div>
        
        <div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'" class="fixed z-30 inset-y-0 left-0 w-64 transition duration-300 transform bg-blue-900 overflow-y-auto lg:translate-x-0 lg:static lg:inset-0">
            <div class="flex items-center justify-center mt-8">
                <div class="flex items-center">
                    <span class="text-white text-2xl font-semibold">YouCode Admin</span>
                </div>
            </div>
            
            <nav class="mt-10">
                <a class="flex items-center mt-4 py-2 px-6 text-gray-100 hover:bg-blue-700 hover:bg-opacity-25 hover:text-gray-100" href="">
                    <i class="fas fa-tachometer-alt mr-3"></i>
                    Tableau de bord
                </a>
                
                <a class="flex items-center mt-4 py-2 px-6 text-gray-100 hover:bg-blue-700 hover:bg-opacity-25 hover:text-gray-100" href="">
                    <i class="fas fa-users mr-3"></i>
                    Candidats
                </a>
                
                <a class="flex items-center mt-4 py-2 px-6 text-gray-100 hover:bg-blue-700 hover:bg-opacity-25 hover:text-gray-100" href="">
                    <i class="fas fa-question-circle mr-3"></i>
                    Quiz
                </a>
                
                <a class="flex items-center mt-4 py-2 px-6 text-gray-100 hover:bg-blue-700 hover:bg-opacity-25 hover:text-gray-100" href="">
                    <i class="fas fa-clipboard-check mr-3"></i>
                    Tests Présentiels
                </a>
                
                <a class="flex items-center mt-4 py-2 px-6 text-gray-100 hover:bg-blue-700 hover:bg-opacity-25 hover:text-gray-100" href="">
                    <i class="fas fa-user-tie mr-3"></i>
                    Personnel
                </a>
                
                <a class="flex items-center mt-4 py-2 px-6 text-gray-100 hover:bg-blue-700 hover:bg-opacity-25 hover:text-gray-100" href="">
                    <i class="fas fa-cog mr-3"></i>
                    Paramètres
                </a>
            </nav>
        </div>
        
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="flex justify-between items-center py-4 px-6 bg-white border-b-4 border-blue-800">
                <div class="flex items-center">
                    <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none lg:hidden">
                        <i class="fas fa-bars text-lg"></i>
                    </button>
                </div>
                
                <div class="flex items-center">
                    <div x-data="{ dropdownOpen: false }" class="relative">
                        <button @click="dropdownOpen = ! dropdownOpen" class="relative block h-8 w-8 rounded-full overflow-hidden shadow focus:outline-none">
                            <img class="h-full w-full object-cover" src="{{ asset('img/admin-avatar.jpg') }}" alt="Avatar">
                        </button>

                        <div x-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 h-full w-full z-10"></div>

                        <div x-show="dropdownOpen" class="absolute right-0 mt-2 w-48 bg-white rounded-md overflow-hidden shadow-xl z-10">
                            <a href="" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-700 hover:text-white">Profile</a>
                            <a href="" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-700 hover:text-white">Paramètres</a>
                            <form action="" method="POST">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-blue-700 hover:text-white">Déconnexion</button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>
            
            <!-- Main content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">
                <div class="container mx-auto px-6 py-8">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
    
    @yield('scripts')
</body>
</html>