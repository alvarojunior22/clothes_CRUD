<div class="h-screen flex items-center justify-center bg-cover bg-center">


    <div class="w-full max-w-4xl bg-white rounded-3xl shadow-2xl overflow-hidden flex">

        <!-- LADO IZQUIERDO (Branding) -->
        <div class="hidden md:flex md:w-1/2 relative">

            <!-- Imagen -->
            <img src="{{ asset('storage/crud.png') }}"
                alt="Clothes CRUD"
                class="absolute inset-0 w-full h-full object-cover">

            <!-- Overlay oscuro -->
            <div class="absolute inset-0 bg-black/20"></div>
            </div>
            <!-- LADO DERECHO (Formulario) -->
            <div class="w-full md:w-1/2 p-12">
                {{ $slot }}
            </div>

        </div>

    </div>