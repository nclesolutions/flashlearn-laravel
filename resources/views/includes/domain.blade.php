@if (session('orgName'))
    <a href="{{ route('school.index') }}" class="btn btn-flex btn-sm btn-outline btn-active-color-primary btn-custom px-4">
        <i class="ki-outline ki-briefcase fs-4 me-2"></i>{{ session('orgName') }}
    </a>
@else
    <span class="btn btn-flex btn-sm btn-outline btn-active-color-primary btn-custom px-4">
        Je hebt een persoonlijk account.
    </span>
@endif
