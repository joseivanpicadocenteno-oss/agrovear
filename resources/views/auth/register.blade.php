<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agrovear - Registro</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#F5F0E6] font-sans text-stone-800 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md bg-white p-8 rounded-xl shadow-md border border-stone-200">
        <h2 class="text-2xl font-bold text-[#76502F] text-center mb-6">Crear Cuenta</h2>

        @if($errors->any())
            <div class="mb-4 p-3 bg-red-100 border border-red-300 text-red-700 text-xs rounded-lg">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-[#76502F] mb-1">Nombre Completo</label>
                <input type="text" name="name" value="{{ old('name') }}" required class="w-full border-stone-300 rounded-lg p-2.5 border text-sm focus:outline-none focus:ring-2 focus:ring-[#397C02]">
            </div>

            <div>
                <label class="block text-xs font-bold text-[#76502F] mb-1">Correo Electrónico</label>
                <input type="email" name="email" value="{{ old('email') }}" required class="w-full border-stone-300 rounded-lg p-2.5 border text-sm focus:outline-none focus:ring-2 focus:ring-[#397C02]">
            </div>

            <div>
                <label class="block text-xs font-bold text-[#76502F] mb-1">Contraseña</label>
                <input type="password" name="password" required class="w-full border-stone-300 rounded-lg p-2.5 border text-sm focus:outline-none focus:ring-2 focus:ring-[#397C02]">
            </div>

            <div>
                <label class="block text-xs font-bold text-[#76502F] mb-1">Confirmar Contraseña</label>
                <input type="password" name="password_confirmation" required class="w-full border-stone-300 rounded-lg p-2.5 border text-sm focus:outline-none focus:ring-2 focus:ring-[#397C02]">
            </div>

            <button type="submit" class="w-full bg-[#397C02] text-white font-bold py-2.5 rounded-lg text-sm hover:bg-opacity-90 transition">
                Registrarse
            </button>
        </form>

        <p class="text-xs text-center text-stone-500 mt-4">
            ¿Ya tienes cuenta? <a href="{{ route('login') }}" class="text-[#397C02] font-bold underline">Inicia sesión</a>
        </p>
    </div>
</body>
</html>