<div class="row my-3">
    <div class="col-1"></div>
    <div class="col-12 col-md-11">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-1">
                <li class="breadcrumb-item"><a href="{{ route('uniView.index') }}">Home</a></li>
                {{ $slot }}
            </ol>
        </nav>
    </div>
</div>
