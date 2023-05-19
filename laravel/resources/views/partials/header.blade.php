<div id="header" class="bg-blue-950 mb-4 flex justify-center align-middle">
    <div class="flex  mx-5 lg:mx-20 max-w-screen-2xl w-full">
        <div class="w-1/3 flex items-center">
            <img src="{{ asset('images/beach-hockey-logo.png') }}" alt="" class="h-auto py-3 w-28">
        </div>
        <div class="w-2/3 flex items-center text-white justify-end">

            @if (Auth::user() == null)

            @elseif (Auth::user()->is_admin)
                <strong>Admin &nbsp;</strong>
            @elseif (Auth::user()->equipo)
                <strong>{{ Auth::user()->equipo->nombre }} &nbsp;</strong>
            @elseif(Auth::user()->name)
                <strong>{{ Auth::user()->espectador->name }} &nbsp; &nbsp;</strong>                
            @endif
            <a href="{{ route('auth.logout') }}">  <i class="fa-solid fa-right-from-bracket" style="color: #ffffff;"></i></a>
        </div>
    </div>
</div>
