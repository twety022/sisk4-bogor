@if (request()->routeIs('profile.tentang'))

    @php
        $aboutNav = [
            ['target' => 'gambaran-umum',           'label' => 'Gambaran Umum',  'icon' => 'bi-building-fill'],
            ['target' => 'sambutan-kepala-sekolah', 'label' => 'Sambutan',       'icon' => 'bi-chat-quote-fill'],
            ['target' => 'visi-misi',               'label' => 'Visi & Misi',    'icon' => 'bi-compass-fill'],
            ['target' => 'komitmen-pendidikan',     'label' => 'Komitmen',       'icon' => 'bi-mortarboard-fill'],
            ['target' => 'fasilitas',               'label' => 'Fasilitas',      'icon' => 'bi-buildings-fill'],
            ['target' => 'struktur',                'label' => 'Struktur',       'icon' => 'bi-diagram-3-fill'],
            ['target' => 'sejarah',                 'label' => 'Sejarah',        'icon' => 'bi-clock-history'],
        ];
    @endphp

    <div class="profile-subnav">
        <div class="container">
            <nav class="profile-subnav__list" aria-label="Navigasi Tentang Sekolah">
                @foreach ($aboutNav as $item)
                    <a href="#{{ $item['target'] }}"
                       class="profile-sidebar-link {{ $loop->first ? 'active' : '' }}">
                        <i class="bi {{ $item['icon'] }}"></i>
                        <span>{{ $item['label'] }}</span>
                    </a>
                @endforeach
            </nav>
        </div>
    </div>


@elseif (request()->routeIs('profile.program'))

//jurusan
    <div class="profile-sidebar">

        <span class="profile-sidebar-label">
            Program Keahlian
        </span>

        <nav
            class="profile-sidebar-nav"
            aria-label="Navigasi Program Keahlian"
        >

            @forelse ($programs as $program)

                @php
                    $programId = 'program-' . strtolower($program->code);
                @endphp

                <a
                    href="#{{ $programId }}"
                    class="profile-sidebar-link {{ $loop->first ? 'active' : '' }}"
                >

                    <i class="bi {{ $program->icon ?? 'bi-mortarboard-fill' }}"></i>

                    <span>
                        {{ $program->code }}
                    </span>

                </a>

            @empty

                <span class="text-muted small">
                    Belum ada program.
                </span>

            @endforelse

        </nav>

    </div>


@elseif (request()->routeIs('profile.fasilitas'))

    <div class="profile-sidebar">

        <span class="profile-sidebar-label">
            Fasilitas
        </span>

        <nav
            class="profile-sidebar-nav"
            aria-label="Navigasi Fasilitas"
        >

            @forelse ($facilities as $facility)

                @php
                    $facilityId = 'fasilitas-' . $loop->iteration;
                @endphp

                <a
                    href="#{{ $facilityId }}"
                    class="profile-sidebar-link {{ $loop->first ? 'active' : '' }}"
                >

                    <i class="bi {{ $facility->icon ?? 'bi-building-fill' }}"></i>

                    <span>
                        {{ $facility->title }}
                    </span>

                </a>

            @empty

                <span class="text-muted small">
                    Belum ada fasilitas.
                </span>

            @endforelse

        </nav>

    </div>


@else

    @php
        $profileNav = [
            [
                'route' => 'profile.tentang',
                'label' => 'Tentang Sekolah',
                'icon' => 'bi-building-fill'
            ],
            [
                'route' => 'profile.program',
                'label' => 'Program Keahlian',
                'icon' => 'bi-mortarboard-fill'
            ],
            [
                'route' => 'profile.fasilitas',
                'label' => 'Fasilitas',
                'icon' => 'bi-building-gear'
            ],
            [
                'route' => 'profile.prestasi',
                'label' => 'Prestasi',
                'icon' => 'bi-trophy-fill'
            ],
        ];
    @endphp


    <div class="profile-sidebar">

        <span class="profile-sidebar-label">
            Profil Sekolah
        </span>

        <nav class="profile-sidebar-nav">

            @foreach ($profileNav as $item)

                <a
                    href="{{ route($item['route']) }}"
                    class="profile-sidebar-link {{ request()->routeIs($item['route']) ? 'active' : '' }}"
                >

                    <i class="bi {{ $item['icon'] }}"></i>

                    <span>
                        {{ $item['label'] }}
                    </span>

                </a>

            @endforeach

        </nav>

    </div>

@endif


@push('scripts')

<script>
document.addEventListener('DOMContentLoaded', function () {

    const sidebarLinks = document.querySelectorAll(
        '.profile-sidebar-link[href^="#"]'
    );

    if (!sidebarLinks.length) return;

    const sections = [];

    sidebarLinks.forEach(link => {

        const targetId = link.getAttribute('href');
        const section = document.querySelector(targetId);

        if (section) {

            sections.push({
                link: link,
                section: section
            });

        }

        link.addEventListener('click', function () {

            sidebarLinks.forEach(item => {
                item.classList.remove('active');
            });

            this.classList.add('active');

        });

    });


    const observer = new IntersectionObserver((entries) => {

        entries.forEach(entry => {

            if (entry.isIntersecting) {

                sidebarLinks.forEach(link => {
                    link.classList.remove('active');
                });

                const activeLink = document.querySelector(
                    '.profile-sidebar-link[href="#' +
                    entry.target.id +
                    '"]'
                );

                if (activeLink) {
                    activeLink.classList.add('active');
                }

            }

        });

    }, {
        rootMargin: '-25% 0px -60% 0px',
        threshold: 0
    });


    sections.forEach(item => {
        observer.observe(item.section);
    });

});
</script>

@endpush