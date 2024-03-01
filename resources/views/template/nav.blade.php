<li class="nav-item @if ($title == 'Spp') {{ 'active' }} @endif">

    <a href="{{ url('/pembayaran') }}" class="nav-link">
        <i class="fas fa-fw fa-cube"></i>
        <span>Spp</span>
    </a>
</li>
@if(Auth::user()->level == 'admin')
<li class="nav-item @if ($title == 'Spp') {{ 'active' }} @endif">

    <a href="{{ url('/akun') }}" class="nav-link">
        <i class="fas fa-fw fa-user"></i>
        <span>Ganti Password User</span>
    </a>
</li>


@endif