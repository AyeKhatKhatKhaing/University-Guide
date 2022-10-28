<div class="row mt-0">
    <div class="col-12 col-lg-6">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-1">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                {{ $slot }}
            </ol>
        </nav>
    </div>
</div>
