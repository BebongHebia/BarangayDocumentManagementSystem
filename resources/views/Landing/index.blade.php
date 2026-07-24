<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BDMS - Barangay Ocho</title>
    <!-- Font Awesome (free icons) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link href="{{ asset('assets/CSS/Landing/index.css') }}" rel="stylesheet">
</head>
<body>

    <!-- HEADER + MENU -->
    <header>
        <div class="container header-flex">
            <div class="logo">
                <img src="{{ asset('assets/images/logo.png') }}" alt="Barangay Ocho Logo" class="logo-img">
                Barangay Ocho, City of Malaybalay
            </div>
            <nav class="nav-menu">
                <a href="#main"><i class="fas fa-home"></i> Main</a>
                <a href="#org"><i class="fas fa-sitemap"></i> Org chart</a>
                <a href="#staff"><i class="fas fa-user-tie"></i> Staff</a>
                <a href="#population"><i class="fas fa-users"></i> Population</a>
                <a href="#profile"><i class="fas fa-info-circle"></i> Profile</a>
                <a href="#activities"><i class="fas fa-calendar-check"></i> Activities</a>
                <a href="#announcements"><i class="fas fa-bullhorn"></i> Announce</a>
                <a href="#history"><i class="fas fa-clock-rotate-left"></i> History</a>
                <a href="#mission"><i class="fas fa-bullseye"></i> Mission</a>
                <a href="#contact"><i class="fas fa-envelope"></i> Contact</a>
            </nav>
            <div class="auth-menu">
                <a href="{{ url('/login') }}" class="auth-btn login-btn"><i class="fas fa-sign-in-alt"></i> Login</a>
                <a href="{{ url('/get-master-lists') }}" class="auth-btn register-btn"><i class="fas fa-user-plus"></i> Register</a>
            </div>
        </div>
    </header>

    <main class="container">

        <!-- ===== HERO WITH BACKGROUND IMAGE & CAROUSEL ===== -->
        <section id="main" class="hero section-animate">
            <div class="hero-bg" id="heroBg"></div>
            <div class="hero-carousel">
                <div class="hero-grid">
                    <!-- slide 1 (active) - ADD data-image HERE -->
                    <div class="hero-text carousel-slide active" data-slide="0" data-image="{{ asset('assets/images/Landing/image_1.jpg') }}">
                        <h1><i class="fas fa-flag"></i> Barangay <br>Ocho, City of Malaybalay</h1>
                        <p><i class="fas fa-hand-peace"></i> Maunlad, mapayapa, at nagkakaisang komunidad para sa lahat.</p>
                        <span class="hero-btn"><i class="fas fa-people-group"></i> Alagang Barangay</span>
                    </div>

                    <!-- slide 2 - ADD data-image HERE -->
                    <div class="hero-text carousel-slide" data-slide="1" data-image="{{ asset('assets/images/Landing/image_7.jpg') }}">
                        <h1><i class="fas fa-hand-holding-heart"></i> Serbisyong <br>Tapat at Mabilis</h1>
                        <p>24/7 na pagtugon sa pangangailangan ng bawat residente. Kami ay handang maglingkod.</p>
                        <span class="hero-btn"><i class="fas fa-clock"></i> Laging Bukas</span>
                    </div>

                    <!-- slide 3 - ADD data-image HERE -->
                    <div class="hero-text carousel-slide" data-slide="2" data-image="{{ asset('assets/images/Landing/image_9.jpg') }}">
                        <h1><i class="fas fa-leaf"></i> Green <br>Barangay 2026</h1>
                        <p>Nagkakaisa para sa malinis at luntiang kapaligiran. Sama-sama nating pangalagaan ang kalikasan.</p>
                        <span class="hero-btn"><i class="fas fa-tree"></i> Magtanim</span>
                    </div>

                    <div class="hero-image">
                        <i class="fas fa-city"></i>
                        <p>🏡 <strong>Brgy. Ocho</strong><br> <span style="font-size:0.9rem;">City of Malaybalay</span></p>
                    </div>
                </div>
            </div>
            <div class="carousel-dots">
                <span class="active" data-slide="0"></span>
                <span data-slide="1"></span>
                <span data-slide="2"></span>
            </div>
            <button class="carousel-control" id="carouselToggle" aria-label="Toggle carousel autoplay">
                <i class="fas fa-pause" id="toggleIcon"></i>
            </button>
        </section>

        <!-- ===== ORGANIZATIONAL CHART ===== -->
        <section id="org" class="section-card section-animate">
            <div class="section-title">
                <i class="fas fa-sitemap"></i> <span>Organizational Chart</span>
            </div>

            @php
            // Get active staff officials
            $activeStaff = \App\Models\StaffOfficial::where('status', 'Active')->with('staffImage')->get();

            // Separate by position
            $punongBarangay = $activeStaff->where('position', 'Punong Barangay')->sortByDesc('id')->first();
            $kagawads = $activeStaff->where('position', 'Kagawad');
            $supporting = $activeStaff->whereIn('position', ['Secretary', 'Treasurer']);
            @endphp

            <div class="org-chart">

                <!-- LEVEL 1: Punong Barangay -->
                <div class="org-level-1">
                    @if($punongBarangay)
                    <div class="org-card">
                        <div class="avatar">
                            @if($punongBarangay->staffImage && $punongBarangay->staffImage->path)
                            <img src="{{ asset('storage/' . $punongBarangay->staffImage->path) }}" alt="{{ $punongBarangay->completeName }}">
                            @elseif($punongBarangay->profile_photo)
                            <img src="{{ asset('storage/' . $punongBarangay->profile_photo) }}" alt="{{ $punongBarangay->completeName }}">
                            @else
                            <i class="fas fa-user-tie"></i>
                            @endif
                        </div>
                        <div class="position">Punong Barangay</div>
                        <div class="name">{{ $punongBarangay->completeName }}</div>
                        <span class="status-badge status-active">● Active</span>
                    </div>
                    @else
                    <div class="org-card" style="border-color: #ccc; opacity: 0.6;">
                        <div class="avatar"><i class="fas fa-user-tie" style="color: #aaa;"></i></div>
                        <div class="position">Punong Barangay</div>
                        <div class="name" style="color: #888;">No active official</div>
                    </div>
                    @endif
                </div>

                <!-- Connector -->
                <div class="org-connector"></div>

                <!-- LEVEL 2: Kagawads -->
                <div class="org-level-label">Barangay Council</div>
                <div class="org-level-2">
                    @forelse($kagawads as $kagawad)
                    <div class="org-card">
                        <div class="avatar">
                            @if($kagawad->staffImage && $kagawad->staffImage->path)
                            <img src="{{ asset('storage/' . $kagawad->staffImage->path) }}" alt="{{ $kagawad->completeName }}">
                            @elseif($kagawad->profile_photo)
                            <img src="{{ asset('storage/' . $kagawad->profile_photo) }}" alt="{{ $kagawad->completeName }}">
                            @else
                            <i class="fas fa-user-circle"></i>
                            @endif
                        </div>
                        <div class="position">Kagawad</div>
                        <div class="name">{{ $kagawad->completeName }}</div>
                        <span class="status-badge status-active">● Active</span>
                    </div>
                    @empty
                    <div class="org-card" style="border-color: #ccc; opacity: 0.6; min-width: 200px;">
                        <div class="avatar"><i class="fas fa-users" style="color: #aaa;"></i></div>
                        <div class="position">Kagawad</div>
                        <div class="name" style="color: #888;">No active officials</div>
                    </div>
                    @endforelse
                </div>

                <!-- Connector to Level 3 -->
                @if($supporting->count() > 0)
                <div class="org-connector" style="height: 30px;"></div>
                @endif

                <!-- LEVEL 3: Supporting Staff -->
                @if($supporting->count() > 0)
                <div class="org-level-label">Supporting Staff</div>
                <div class="org-level-3">
                    @foreach($supporting as $staff)
                    <div class="org-card">
                        <div class="avatar">
                            @if($staff->staffImage && $staff->staffImage->path)
                            <img src="{{ asset('storage/' . $staff->staffImage->path) }}" alt="{{ $staff->completeName }}">
                            @elseif($staff->profile_photo)
                            <img src="{{ asset('storage/' . $staff->profile_photo) }}" alt="{{ $staff->completeName }}">
                            @else
                            <i class="fas fa-user-cog"></i>
                            @endif
                        </div>
                        <div class="position">{{ $staff->position }}</div>
                        <div class="name">{{ $staff->completeName }}</div>
                        <span class="status-badge status-active">● Active</span>
                    </div>
                    @endforeach
                </div>
                @endif

            </div>
        </section>

        <!-- STAFF & OFFICIALS -->
        <section id="staff" class="section-card section-animate">
            <div class="section-title">
                <i class="fas fa-user-tie"></i> <span>All Staff &amp; Officials</span>
            </div>
            <div class="staff-grid">
                @forelse($activeStaff as $staff)
                <div class="staff-card">
                    @php
                    $imagePath = null;
                    if($staff->staffImage && $staff->staffImage->path) {
                    $imagePath = $staff->staffImage->path;
                    } elseif($staff->profile_photo) {
                    $imagePath = $staff->profile_photo;
                    }
                    @endphp

                    @if($imagePath)
                    <img src="{{ asset('storage/' . $imagePath) }}" alt="{{ $staff->completeName }}" class="avatar-small">
                    @else
                    <div class="avatar-icon">
                        <i class="fas fa-user-circle"></i>
                    </div>
                    @endif
                    <div class="name">{{ $staff->completeName }}</div>
                    <div class="role">{{ $staff->position }}</div>
                </div>
                @empty
                <div style="grid-column: 1 / -1; text-align: center; padding: 2rem; color: #5a7a7a;">
                    <i class="fas fa-users" style="font-size: 2rem; display: block; margin-bottom: 0.5rem;"></i>
                    No active staff members found.
                </div>
                @endforelse
            </div>
        </section>

        <!-- POPULATION -->
        <section id="population" class="section-card section-animate">
            <div class="section-title">
                <i class="fas fa-users"></i> <span>Population</span>
            </div>

            @php
            // Get population statistics from MasterList
            $totalResidents = \App\Models\MasterList::count();
            $maleResidents = \App\Models\MasterList::where('sex', 'Male')->count();
            $femaleResidents = \App\Models\MasterList::where('sex', 'Female')->count();
            $activeResidents = \App\Models\MasterList::where('status', 'Active')->count();
            $inactiveResidents = \App\Models\MasterList::where('status', 'Inactive')->count();
            @endphp

            <!-- Population Stats -->
            <div class="pop-stats">
                <div class="pop-item">
                    <div class="number">{{ number_format($totalResidents) }}</div>
                    <div class="label">Kabuuang residente</div>
                </div>
                <div class="pop-item">
                    <div class="number">{{ number_format($maleResidents) }}</div>
                    <div class="label">Lalaki</div>
                </div>
                <div class="pop-item">
                    <div class="number">{{ number_format($femaleResidents) }}</div>
                    <div class="label">Babae</div>
                </div>
                <div class="pop-item">
                    <div class="number">{{ number_format($activeResidents) }}</div>
                    <div class="label">Active</div>
                </div>
                <div class="pop-item">
                    <div class="number">{{ number_format($inactiveResidents) }}</div>
                    <div class="label">Inactive</div>
                </div>
            </div>

            <!-- Google Map -->
            <div class="map-container" style="margin-top: 2rem; border-radius: 2rem; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3944.123456789!2d125.1286233!3d8.1532761!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x32ffaa288fd8a759%3A0x95e16b230d9904bf!2sBarangay%208%2C%20Malaybalay%20City%2C%20Bukidnon!5e0!3m2!1sen!2sph!4v1700000000000!5m2!1sen!2sph" width="100%" height="400" style="border:0; display: block;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </section>

        <!-- UPCOMING ACTIVITIES -->
        <section id="activities" class="section-card section-animate">
            <div class="section-title">
                <i class="fas fa-calendar-check"></i> <span>Upcoming Activities</span>
            </div>

            @php
            // Get upcoming activities with status 'Ongoing' or 'Upcoming'
            // You can adjust the status filter as needed
            $upcomingActivities = \App\Models\CalendarActivity::whereIn('status', ['Ongoing', 'Upcoming'])
            ->orWhere('dateStart', '>=', now())
            ->orderBy('dateStart', 'asc')// Limit to 6 activities
            ->get();
            @endphp

            <div class="activity-list">
                @forelse($upcomingActivities as $activity)
                <div class="activity-item">
                    @php
                    // Get the first image for this activity
                    $activityImage = $activity->getCalActImage;
                    @endphp

                    @if($activityImage && $activityImage->path)
                    <img src="{{ asset($activityImage->path) }}" alt="{{ $activity->activity }}" style="width: 2.5rem; height: 2.5rem; border-radius: 50%; object-fit: cover;">
                    @else
                    <i class="fas fa-calendar-day"></i>
                    @endif

                    <div class="info">
                        <strong>{{ $activity->activity }}</strong>
                        <span>{{ $activity->description }}</span>
                        <span style="display: block; font-size: 0.8rem; color: #0b3b3c; margin-top: 0.2rem;">
                            <i class="fas fa-calendar-alt"></i>
                            {{ \Carbon\Carbon::parse($activity->dateStart)->format('F d, Y') }}
                            @if($activity->dateEnd && $activity->dateEnd != $activity->dateStart)
                            - {{ \Carbon\Carbon::parse($activity->dateEnd)->format('F d, Y') }}
                            @endif
                        </span>
                    </div>
                    <div class="badge" style="background: {{ $activity->status == 'Ongoing' ? '#ffc107' : '#F20519' }}; color: {{ $activity->status == 'Ongoing' ? '#000' : '#fff' }};">
                        {{ $activity->status }}
                    </div>
                </div>
                @empty
                <div style="text-align: center; padding: 2rem; color: #5a7a7a;">
                    <i class="fas fa-calendar-plus" style="font-size: 2rem; display: block; margin-bottom: 0.5rem;"></i>
                    No upcoming activities at the moment.
                </div>
                @endforelse
            </div>
        </section>

        <!-- ANNOUNCEMENTS -->
        <section id="announcements" class="section-card section-animate">
            <div class="section-title">
                <i class="fas fa-bullhorn"></i> <span>Announcements</span>
            </div>

            @php
            // Get all announcements with their images
            $announcements = \App\Models\Announcement::with('image')
            ->orderBy('created_at', 'desc')
            ->get();
            @endphp

            <div class="announce-list">
                @forelse($announcements as $announcement)
                <div class="announce-item">
                    @if($announcement->image && $announcement->image->path)
                    <img src="{{ asset('storage/' . $announcement->image->path) }}" alt="{{ $announcement->title }}" class="announce-img">
                    @else
                    <i class="fas fa-bullhorn" style="color: #F20519;"></i>
                    @endif

                    <div class="info">
                        <strong>{{ $announcement->title }}</strong>
                        <span>
                            @if($announcement->what)
                            <span class="announce-detail"><i class="fas fa-info-circle"></i> {{ $announcement->what }}</span>
                            @endif
                            @if($announcement->when)
                            <span class="announce-detail"><i class="fas fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($announcement->when)->format('F d, Y') }}</span>
                            @endif
                            @if($announcement->where)
                            <span class="announce-detail"><i class="fas fa-map-marker-alt"></i> {{ $announcement->where }}</span>
                            @endif
                            @if($announcement->how)
                            <span class="announce-detail"><i class="fas fa-info-circle"></i> {{ $announcement->how }}</span>
                            @endif
                        </span>
                        @if($announcement->description)
                        <span class="announce-description">{{ $announcement->description }}</span>
                        @endif
                    </div>
                    <div class="badge">Basahin</div>
                </div>
                @empty
                <div style="text-align: center; padding: 2rem; color: #5a7a7a;">
                    <i class="fas fa-bullhorn" style="font-size: 2rem; display: block; margin-bottom: 0.5rem;"></i>
                    No announcements at the moment.
                </div>
                @endforelse
            </div>
        </section>

        <!-- ===== BARANGAY PROFILE ===== -->
        <section id="profile" class="section-card section-animate">
            <div class="section-title">
                <i class="fas fa-info-circle"></i> <span>Barangay Profile</span>
            </div>

            <div class="profile-content">
                <div class="profile-grid">
                    <div class="profile-text">
                        <div class="profile-item">
                            <h4><i class="fas fa-map-marked-alt"></i> Land Area & Location</h4>
                            <p>Barangay 08 has a total land area of <strong>9.24 hectares</strong> which are flat lands. The entire land area is classified as commercial and is alienable and disposable.</p>
                            <p>It is bounded on the east by Barangay 9 and 6, in the west by Barangay 7, in the north by Barangay 5 and in the south by Barangay 9.</p>
                            <p>It is located along the national highway, flat land and suited for commercial purposes.</p>
                        </div>

                        <div class="profile-item">
                            <h4><i class="fas fa-layer-group"></i> Sectors</h4>
                            <p>There are <strong>three sectors</strong> in the barangay. These sectors are equivalent to the puroks and zones of other barangays. Each sector has its own set of officials that the residents can consult to whenever they have concerns.</p>
                        </div>
                    </div>

                    <div class="profile-sidebar">
                        <div class="profile-badge">
                            <i class="fas fa-flag"></i>
                            <div style="font-weight: 700; font-size: 1.2rem;">Barangay 8</div>
                            <div style="font-size: 0.9rem; color: #2b5f5f;">Malaybalay City</div>
                            <hr style="margin: 0.8rem 0;">
                            <div style="font-size: 0.9rem;">
                                <div><i class="fas fa-arrows-alt-h"></i> Area: 9.24 ha</div>
                                <div><i class="fas fa-tag"></i> Classification: Commercial</div>
                                <div><i class="fas fa-city"></i> Sectors: 3</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ===== HISTORY ===== -->
        <section id="history" class="section-card section-animate">
            <div class="section-title">
                <i class="fas fa-clock-rotate-left"></i> <span>History & Leadership</span>
            </div>

            <div class="history-full">
                <!-- Historical Background -->
                <div class="history-background">
                    <h3><i class="fas fa-landmark"></i> Historical Background</h3>
                    <div class="history-text-content">
                        <p>Malaybalay is the capital city of the Province of Bukidnon. During the early days, most of the inhabitants were natives of Bukidnon. Later on, people from different parts of Visayas, Mindanao and even in Luzon came to settle down here in Malaybalay because it is such a beautiful place with all the panoramic views around.</p>

                        <p>The climate of Malaybalay is cold even during the hottest days of summer. For this, Malaybalay can be compared to Baguio City which is the summer capital of the country. Malaybalay can be the summer capital of the south.</p>

                        <p>The people here are peace-loving, even if they come from different parts of the country, with different cultures, beliefs and dialect, there are no conflicts among them.</p>

                        <p>During the administration of Hon. Lorenzo S. Dinlayan, Sr. as municipal Mayor of Malaybalay, Barangay 15 was created and Barangays 6, 7, and 8 were under it. The first appointed barangay Captain of Barangay 15 was the late <strong>Nicasio Sotelo</strong>.</p>

                        <p>Then in <strong>1974</strong>, during the administration of Hon. Mayor Timoteo C. Ocaya, Barangay 8 was created.</p>
                    </div>
                </div>


                <!-- Barangay Captains / Leaders Timeline -->
                <div class="history-leaders">
                    <h3><i class="fas fa-users"></i> Barangay Leaders Through the Years</h3>
                    <div class="leaders-timeline">
                        <div class="leader-item">
                            <div class="leader-year">1962-1966</div>
                            <div class="leader-info">
                                <div class="leader-name">Nicasio Sotelo</div>
                                <div class="leader-position">Punong Barangay (4 years)</div>
                                <div class="leader-notes">First appointed barangay Captain of Barangay 15</div>
                            </div>
                        </div>

                        <div class="leader-item">
                            <div class="leader-year">1966-1974</div>
                            <div class="leader-info">
                                <div class="leader-name">Elisa D. Feliciano</div>
                                <div class="leader-position">Punong Barangay (8 years)</div>
                            </div>
                        </div>

                        <div class="leader-item">
                            <div class="leader-year">1974-1980</div>
                            <div class="leader-info">
                                <div class="leader-name">Reginaldo N. Tilanduca</div>
                                <div class="leader-position">Punong Barangay (6 years)</div>
                                <div class="leader-notes">Later became Municipal Mayor and Congressman</div>
                            </div>
                        </div>

                        <div class="leader-item">
                            <div class="leader-year">1980-2007</div>
                            <div class="leader-info">
                                <div class="leader-name">Clarita C. Carbajal</div>
                                <div class="leader-position">Punong Barangay (27 years)</div>
                                <div class="leader-notes">LIGA President Malaybalay Chapter, Municipal Councilor, Vice President LIGA ng mga Barangay Bukidnon Chapter, City Councilor</div>
                            </div>
                        </div>

                        <div class="leader-item">
                            <div class="leader-year">2007-2018</div>
                            <div class="leader-info">
                                <div class="leader-name">Paciencia R. Gamboa</div>
                                <div class="leader-position">Punong Barangay (11 years)</div>
                            </div>
                        </div>

                        <div class="leader-item current">
                            <div class="leader-year">2018-Present</div>
                            <div class="leader-info">
                                <div class="leader-name">Julius N. Manghano</div>
                                <div class="leader-position">Punong Barangay</div>
                                <div class="leader-notes">Current LIGA President Malaybalay Chapter / City Councilor</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- MISSION & VISION (Keep for backward compatibility) -->
        <section id="mission" class="section-card section-animate">
            <div class="section-title">
                <i class="fas fa-bullseye"></i> <span>Misyon at Bisyon</span>
            </div>
            <div class="mv-grid">
                <div class="mv-box">
                    <h3><i class="fas fa-flag-checkered"></i> Mission</h3>
                    <p>MISSION Ang Barangay Ocho, Adunay Kinasingkasing Nga Kadasig Sa Pagserbisyo, Gugma Ug Kalipay, Kaalam Nga Mopatigbabaw Ang Kalinaw Sa Hiniusang Tumong Ug Tinguha Pinasubay Sa Sabakan Sa Ginoo, Alang Sa Kalamboan Sa Atong Katawhan Sa Barangay</p>
                </div>
                <div class="mv-box">
                    <h3><i class="fas fa-eye"></i> Vision</h3>
                    <p>VISSION Ang BArangay Ocho, Naglantaw Nga Kini Mahimung Usa Ka Sumbanan Sa Pagpangaliya Sa Ginoo, Sa Insaktong Pag Disiplina, Pagmatuto, Ug Paggiya Sa Malinawon Ug Mabungahon Nga Barangay</p>
                </div>
            </div>
        </section>

        <!-- CONTACT US -->
        <section id="contact" class="section-card section-animate">
            <div class="section-title">
                <i class="fas fa-envelope"></i> <span>Contact Us</span>
            </div>
            <div class="contact-grid">
                <div class="contact-info">
                    <p><i class="fas fa-location-dot"></i> Brgy. Ocho, City of Malaybalay, Bukidnon</p>
                    <p><i class="fas fa-phone"></i> 0975-837-4822</p>
                    <p><i class="fas fa-envelope"></i> barangayeight@gmail.com</p>
                </div>
                <div class="contact-form">
                    <!-- Contact form can be added here -->
                </div>
            </div>
        </section>

    </main>

    <!-- FOOTER -->
    <footer>
        <div class="container">
            <div class="footer-grid">
                <div class="footer-copy">
                    <i class="fas fa-tree"></i> Barangay Ocho · 2026
                </div>
                <div class="footer-links">
                    <a href="#main">Main</a>
                    <a href="#org">Org chart</a>
                    <a href="#staff">Staff</a>
                    <a href="#population">Population</a>
                    <a href="#profile">Profile</a>
                    <a href="#activities">Activities</a>
                    <a href="#announcements">Announce</a>
                    <a href="#history">History</a>
                    <a href="#mission">Mission</a>
                    <a href="#contact">Contact</a>
                </div>
                <div class="footer-social">
                    <!-- Social links can be added here -->
                </div>
            </div>
            <hr>
            <div class="footer-bottom">
                <i class="fas fa-hand-holding-heart"></i> Serbisyong tapat, bayan ang una · <i class="fas fa-flag"></i>
            </div>
        </div>
    </footer>

    <!-- Carousel JavaScript -->
    <script src="{{ asset('assets/Javascripts/Landing/index.js') }}"></script>

    <!-- Scroll Animation JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Scroll animation for sections
            const sections = document.querySelectorAll('.section-animate');

            const observerOptions = {
                threshold: 0.15
                , rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, observerOptions);

            sections.forEach(section => {
                observer.observe(section);
            });

            // Smooth scroll for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href');
                    if (targetId === '#') return;

                    const targetElement = document.querySelector(targetId);
                    if (targetElement) {
                        const headerOffset = 80;
                        const elementPosition = targetElement.getBoundingClientRect().top;
                        const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

                        window.scrollTo({
                            top: offsetPosition
                            , behavior: 'smooth'
                        });
                    }
                });
            });
        });

    </script>

</body>
</html>
