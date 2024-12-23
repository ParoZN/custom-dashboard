<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        @vite(['resources/css/app.css'])
        @livewireStyles
        @livewireScripts
        <style>
            body {
                font-family: 'Inter', sans-serif;
            }
            [x-cloak] { display: none !important; }
            
            /* Custom scrollbar */
            ::-webkit-scrollbar {
                width: 6px;
                height: 6px;
            }
            ::-webkit-scrollbar-track {
                background: #f1f5f9;
            }
            ::-webkit-scrollbar-thumb {
                background: #cbd5e1;
                border-radius: 3px;
            }
            ::-webkit-scrollbar-thumb:hover {
                background: #94a3b8;
            }
            
            /* Smooth transitions */
            .transition-all {
                transition-property: all;
                transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
                transition-duration: 150ms;
            }
        </style>
    </head>

    <body class="bg-slate-100" x-data="{ sidebarOpen: false }">
        <div class="flex h-screen overflow-hidden">
            @include('layouts.partials.sidebar')

            <div class="flex-1 flex flex-col overflow-hidden">
                @include('layouts.partials.header')

                <!-- Page Content -->
                <main class="flex-1 overflow-x-hidden overflow-y-auto bg-slate-100 p-6">
                    <div class="container mx-auto">
                        {{ $slot }}
                    </div>
                </main>
            </div>
        </div>

        @stack('modals')
        
    </body>
</html>
