<div class="card mb-5 mb-xl-10">
    <div class="card-body pt-9 pb-0">
        <div class="d-flex overflow-auto h-55px">
            <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder flex-nowrap">
                <li class="nav-item">
                    <a class="nav-link text-active-primary me-6 {{ (isset($sectionName) && $sectionName ==='cms' || Request::is('front-cms-settings*')) ? 'active' : ''}}"
                       href="{{ route('front.settings.index', ['section' => 'cms']) }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-active-primary me-6 {{ (isset($sectionName) && $sectionName === 'about_us') ? 'active' : ''}}"
                       href="{{ route('front.settings.index', ['section' => 'about_us']) }}">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-active-primary me-6 {{ (isset($sectionName) && $sectionName === 'appointment') ? 'active' : ''}}"
                       href="{{ route('front.settings.index',['section' => 'appointment']) }}">Appointment</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-active-primary me-6 {{ (isset($sectionName) && $sectionName === 'terms_and_conditions') ? 'active' : ''}}"
                       href="{{ route('front.settings.index',['section' => 'terms_and_conditions']) }}">Terms and
                        conditions</a>
                </li>
            </ul>
        </div>
    </div>
</div>
