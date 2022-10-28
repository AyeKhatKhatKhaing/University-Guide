<li class="menu-item">
    <a href="{{ $link }}" class="menu-item-link {{ Request::url() == $link ? 'active' : '' }}">
        <span class="text-dark">
            <i class="{{ $class }} mr-2 fa-fw"></i>
            {{ $name }}
        </span>
        @if($counter >= 0)
        <p class="mb-0 badge badge-pill bg-white shadow-sm text-primary counter">{{ $counter }}</p>
            @endif
    </a>
</li>
