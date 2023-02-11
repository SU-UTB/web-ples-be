@php
    $aDashboard = '';
    $aReservations = '';
    $aLandingContent = '';
    $aLandingContacts = '';
    $aLandingTickets = '';
    if (request()->routeIs('dashboard')) {
        $aDashboard = 'active';
    } elseif (request()->routeIs('reservations')) {
        $aReservations = 'active';
    } elseif (request()->routeIs('landingEdit')) {
        $aLandingContent = 'active';
    } elseif (request()->routeIs('contactsEdit')) {
        $aLandingContacts = 'active';
    } elseif (request()->routeIs('ticketsEdit')) {
        $aLandingTickets = 'active';
    }
@endphp

<nav class="navbar navbar-expand-lg navbar-light bg-light">

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link {{ $aDashboard }}" href="/admin">Dashboard </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $aReservations }}" href="/admin/reservations">Reservations</a>
            </li>
            {{--        <li class="nav-item">
                <a class="nav-link {{ $aLandingContent }}" href="/admin/content/landing">Landing/Content</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $aLandingContacts }}" href="/admin/content/landing/contacts">Landing/Contacts</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $aLandingTickets }}" href="/admin/content/landing/tickets">Landing/Tickets</a>
            </li>
 --}}
        </ul>
        <div class="mx-auto"></div>
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <form method="POST" action="{{ route('logout') }}" name="logout-form" id="logout-form" >
                    @csrf

                    <div class="form-group">
                        <button type="submit" class="btn btn-blue">Logout</button>
                    </div>
                </form>
            </li>
        </ul>
    </div>
</nav>
