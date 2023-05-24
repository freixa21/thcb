@if (Auth::user() == null)
@elseif (Auth::user()->is_admin)
    <nav class="bg-blue-950 py-4 px-6 md:flex md:items-center md:justify-between">
        <div class="flex justify-between items-center">
            <div>
                <img class="h-8" src="{{ asset('images/beach-hockey-logo.png') }}" alt="Logo">
            </div>
            <div class="md:hidden">
                <i id="navToggle" class="nav-toggle fa-solid fa-bars hover:text-white focus:outline-none" style="color: #ffffff;"></i>
            </div>
        </div>
        <div id="navMenu" class="md:flex items-center mt-4 md:mt-0">
            <a class="block text-white mt-4 md:inline-block md:mt-0 md:ml-6" href="{{ route('admin.index') }}">General</a>
            <a class="block text-white mt-4 md:inline-block md:mt-0 md:ml-6" href="{{ route('admin.equips') }}">Equips</a>
            <a class="block text-white mt-4 md:inline-block md:mt-0 md:ml-6" href="{{ route('admin.espectadors') }}">Espectadors</a>
            <a class="block text-white mt-4 md:inline-block md:mt-0 md:ml-6 cursor-default font-bold">Admin &nbsp;</a>
            <a href="{{ route('auth.logout') }}"> <i class="fa-solid fa-right-from-bracket"
                    style="color: #ffffff;"></i></a>
        </div>
    </nav>
@elseif (Auth::user()->equipo)
    <div id="header" class="bg-blue-950 mb-4 flex justify-center align-middle">
        <div class="flex  mx-5 lg:mx-20 max-w-screen-2xl w-full">
            <div class="w-1/3 flex items-center">
                <img src="{{ asset('images/beach-hockey-logo.png') }}" alt="" class="h-auto py-3 w-28">
            </div>
            <div class="w-2/3 flex items-center text-white justify-end">
                <strong>{{ Auth::user()->equipo->nombre }} &nbsp;</strong>

                <a href="{{ route('auth.logout') }}"> <i class="fa-solid fa-right-from-bracket"
                        style="color: #ffffff;"></i></a>
            </div>
        </div>
    </div>
@elseif(Auth::user()->name)
    <div id="header" class="bg-blue-950 mb-4 flex justify-center align-middle">
        <div class="flex  mx-5 lg:mx-20 max-w-screen-2xl w-full">
            <div class="w-1/3 flex items-center">
                <img src="{{ asset('images/beach-hockey-logo.png') }}" alt="" class="h-auto py-3 w-28">
            </div>
            <div class="w-2/3 flex items-center text-white justify-end">
                <strong>{{ Auth::user()->espectador->name }} &nbsp; &nbsp;</strong>

                <a href="{{ route('auth.logout') }}"> <i class="fa-solid fa-right-from-bracket"
                        style="color: #ffffff;"></i></a>
            </div>
        </div>
    </div>
@endif
