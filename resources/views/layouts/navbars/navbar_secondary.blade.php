@auth()
    @include('layouts.navbars.navs.auth_secondary')
@endauth

@guest()
    @include('layouts.navbars.navs.guest')
@endguest
