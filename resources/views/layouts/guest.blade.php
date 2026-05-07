<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Edulitnum</title>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@900&family=Poppins:wght@400;600&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="font-sans antialiased" style="background-color: #FEFDDF;">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <div>
                <a href="/">
                    <div class="w-20 h-20 bg-[#E87F24] rounded-[2rem] flex items-center justify-center shadow-2xl shadow-orange-500/40 rotate-3">
                        <span class="text-white font-black text-4xl" style="font-family: 'Montserrat';">E</span>
                    </div>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-10 px-8 py-10 bg-white/60 backdrop-blur-xl shadow-2xl overflow-hidden sm:rounded-[3rem] border border-white">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>