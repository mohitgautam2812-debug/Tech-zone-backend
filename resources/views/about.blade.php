    <x-app-layout>

        <div class="container-fluid py-4 tz-admin-page">

            
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h2 class="fw-bold mb-1" style="font-size: 1.6rem;">About Page Content Manager</h2>
                    <p class="text-muted small mb-0">Manage all about page sections from one place</p>
                </div>
                <span class="badge bg-success rounded-pill px-3 py-2" style="font-size: 0.75rem;">
                    About Page
                </span>
            </div>

        
            @if(session('success'))
                <div class="alert alert-success rounded-3 mb-4">{{ session('success') }}</div>
            @endif

        
            <div class="tz-section-card mb-4">
                <div class="tz-section-header">
                    <div class="tz-section-label">
                        <span class="tz-section-icon bg-blue-soft text-primary">&#9733;</span>
                        <div>
                            <h5 class="fw-bold mb-0">Hero Section</h5>
                            <p class="text-muted small mb-0">Top banner — badge, heading, highlight, description, buttons
                            </p>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('about.hero.update') }}" method="POST">
                        @csrf

                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="tz-label">Badge Text</label>
                                <input type="text" name="hero_badge" class="form-control tz-input"
                                    placeholder="e.g. ABOUT TECHZONE"
                                    value="{{ old('hero_badge', $pageData['hero']['badge'] ?? '') }}">
                            </div>
                            <div class="col-md-4">
                                <label class="tz-label">Heading</label>
                                <input type="text" name="hero_heading" class="form-control tz-input"
                                    placeholder="e.g. India's Most Trusted"
                                    value="{{ old('hero_heading', $pageData['hero']['heading'] ?? '') }}">
                            </div>
                            <div class="col-md-4">
                                <label class="tz-label">Highlighted Word</label>
                                <input type="text" name="hero_highlight" class="form-control tz-input"
                                    placeholder="e.g. Smart Tech Store"
                                    value="{{ old('hero_highlight', $pageData['hero']['highlight'] ?? '') }}">
                            </div>
                            <div class="col-12">
                                <label class="tz-label">Description</label>
                                <textarea name="hero_description" rows="2" class="form-control tz-input"
                                    placeholder="We're on a mission to make premium technology accessible...">{{ old('hero_description', $pageData['hero']['description'] ?? '') }}</textarea>
                            </div>
                            <div class="col-md-3">
                                <label class="tz-label">Primary Button Text</label>
                                <input type="text" name="hero_btn1_text" class="form-control tz-input"
                                    placeholder="e.g. Shop Now"
                                    value="{{ old('hero_btn1_text', $pageData['hero']['btn1_text'] ?? '') }}">
                            </div>
                            <div class="col-md-3">
                                <label class="tz-label">Primary Button Link</label>
                                <input type="text" name="hero_btn1_link" class="form-control tz-input"
                                    placeholder="/products"
                                    value="{{ old('hero_btn1_link', $pageData['hero']['btn1_link'] ?? '') }}">
                            </div>
                            <div class="col-md-3">
                                <label class="tz-label">Secondary Button Text</label>
                                <input type="text" name="hero_btn2_text" class="form-control tz-input"
                                    placeholder="e.g. Contact Us"
                                    value="{{ old('hero_btn2_text', $pageData['hero']['btn2_text'] ?? '') }}">
                            </div>
                            <div class="col-md-3">
                                <label class="tz-label">Secondary Button Link</label>
                                <input type="text" name="hero_btn2_link" class="form-control tz-input"
                                    placeholder="/contact"
                                    value="{{ old('hero_btn2_link', $pageData['hero']['btn2_link'] ?? '') }}">
                            </div>
                        </div>

                        <div class="tz-form-footer">
                            <button type="submit" class="btn btn-primary rounded-pill px-4">Save Hero Section</button>
                        </div>
                    </form>
                </div>
            </div>

        
            <div class="tz-section-card mb-4">
                <div class="tz-section-header">
                    <div class="tz-section-label">
                        <span class="tz-section-icon bg-success-soft text-success">&#9650;</span>
                        <div>
                            <h5 class="fw-bold mb-0">Stats Bar</h5>
                            <p class="text-muted small mb-0">4 stat tiles — icon class, number, label</p>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('about.stats.update') }}" method="POST">
                        @csrf

                        @for ($i = 1; $i <= 4; $i++)
                            <div class="row g-3 mb-3 align-items-end">
                                <div class="col-auto d-flex align-items-center" style="padding-top:28px;">
                                    <span class="tz-step-badge">{{ $i }}</span>
                                </div>
                                <div class="col-md-3">
                                    <label class="tz-label">Icon Class</label>
                                    <input type="text" name="stat_{{ $i }}_icon" class="form-control tz-input"
                                        placeholder="e.g. fa-users"
                                        value="{{ old('stat_' . $i . '_icon', $pageData['stats'][$i - 1]['icon'] ?? '') }}">
                                </div>
                                <div class="col-md-3">
                                    <label class="tz-label">Number</label>
                                    <input type="text" name="stat_{{ $i }}_number" class="form-control tz-input"
                                        placeholder="e.g. 2M+"
                                        value="{{ old('stat_' . $i . '_number', $pageData['stats'][$i - 1]['number'] ?? '') }}">
                                </div>
                                <div class="col">
                                    <label class="tz-label">Label</label>
                                    <input type="text" name="stat_{{ $i }}_label" class="form-control tz-input"
                                        placeholder="e.g. Happy Customers"
                                        value="{{ old('stat_' . $i . '_label', $pageData['stats'][$i - 1]['label'] ?? '') }}">
                                </div>
                            </div>
                            @if ($i < 4)
                            <hr class="tz-divider"> @endif
                        @endfor

                        <div class="tz-form-footer">
                            <button type="submit" class="btn btn-primary rounded-pill px-4">Save Stats Bar</button>
                        </div>
                    </form>
                </div>
            </div>

        
            <div class="tz-section-card mb-4">
                <div class="tz-section-header">
                    <div class="tz-section-label">
                        <span class="tz-section-icon bg-info-soft text-info">&#9432;</span>
                        <div>
                            <h5 class="fw-bold mb-0">Our Story Section</h5>
                            <p class="text-muted small mb-0">Badge, heading, paragraphs, highlight text, right panel, bullet
                                list</p>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('about.story.update') }}" method="POST">
                        @csrf

                        <div class="row g-3">
                            <div class="col-md-3">
                                <label class="tz-label">Badge Text</label>
                                <input type="text" name="story_badge" class="form-control tz-input"
                                    placeholder="e.g. OUR STORY"
                                    value="{{ old('story_badge', $pageData['story']['badge'] ?? '') }}">
                            </div>
                            <div class="col-md-9">
                                <label class="tz-label">Heading</label>
                                <input type="text" name="story_heading" class="form-control tz-input"
                                    placeholder="e.g. Built by tech lovers, for tech lovers"
                                    value="{{ old('story_heading', $pageData['story']['heading'] ?? '') }}">
                            </div>
                            <div class="col-12">
                                <label class="tz-label">Paragraph 1</label>
                                <textarea name="story_para1" rows="3" class="form-control tz-input"
                                    placeholder="TechZone was born in 2019 when our founder...">{{ old('story_para1', $pageData['story']['para1'] ?? '') }}</textarea>
                            </div>
                            <div class="col-12">
                                <label class="tz-label">Highlighted Sentence <span class="text-muted fw-normal">(shown in
                                        blue/bold mid-paragraph)</span></label>
                                <input type="text" name="story_highlight" class="form-control tz-input"
                                    placeholder="e.g. every product must be 100% genuine, competitively priced, and delivered fast"
                                    value="{{ old('story_highlight', $pageData['story']['highlight'] ?? '') }}">
                            </div>
                            <div class="col-12">
                                <label class="tz-label">Paragraph 2</label>
                                <textarea name="story_para2" rows="3" class="form-control tz-input"
                                    placeholder="Today, TechZone is powered by a proprietary AI engine...">{{ old('story_para2', $pageData['story']['para2'] ?? '') }}</textarea>
                            </div>

                            <div class="col-md-6">
                                <label class="tz-label">Right Panel — Title</label>
                                <input type="text" name="story_panel_title" class="form-control tz-input"
                                    placeholder="e.g. TechZone AI Engine"
                                    value="{{ old('story_panel_title', $pageData['story']['panel_title'] ?? '') }}">
                            </div>
                            <div class="col-md-6">
                                <label class="tz-label">Right Panel — Subtitle</label>
                                <input type="text" name="story_panel_subtitle" class="form-control tz-input"
                                    placeholder="e.g. Personalizing 2M+ shopping journeys"
                                    value="{{ old('story_panel_subtitle', $pageData['story']['panel_subtitle'] ?? '') }}">
                            </div>

                            <div class="col-12">
                                <label class="tz-label">Bullet Points <span class="text-muted fw-normal">(one per
                                        line)</span></label>
                                <textarea name="story_bullets" rows="6" class="form-control tz-input"
                                    placeholder="Real-time price tracking across 500+ brands&#10;AI recommendations that actually understand you&#10;Automated fraud detection on every order&#10;Predictive inventory management for zero stockouts&#10;Smart logistics routing for fastest delivery">{{ old('story_bullets', $pageData['story']['bullets'] ?? '') }}</textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="tz-label">Trust Label <span class="text-muted fw-normal">(bottom of
                                        panel)</span></label>
                                <input type="text" name="story_trust_label" class="form-control tz-input"
                                    placeholder="e.g. Trusted by 2M+ customers across India"
                                    value="{{ old('story_trust_label', $pageData['story']['trust_label'] ?? '') }}">
                            </div>
                        </div>

                        <div class="tz-form-footer">
                            <button type="submit" class="btn btn-primary rounded-pill px-4">Save Our Story Section</button>
                        </div>
                    </form>
                </div>
            </div>

        
            <div class="tz-section-card mb-4">
                <div class="tz-section-header">
                    <div class="tz-section-label">
                        <span class="tz-section-icon bg-warning-soft text-warning">&#9670;</span>
                        <div>
                            <h5 class="fw-bold mb-0">Core Values Section</h5>
                            <p class="text-muted small mb-0">Section header + up to 6 value cards (icon, title, description)
                            </p>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('about.values.update') }}" method="POST">
                        @csrf

                    
                        <div class="row g-3 mb-4">
                            <div class="col-md-3">
                                <label class="tz-label">Badge Text</label>
                                <input type="text" name="values_badge" class="form-control tz-input"
                                    placeholder="e.g. WHAT WE STAND FOR"
                                    value="{{ old('values_badge', $pageData['values']['badge'] ?? '') }}">
                            </div>
                            <div class="col-md-4">
                                <label class="tz-label">Section Heading</label>
                                <input type="text" name="values_heading" class="form-control tz-input"
                                    placeholder="e.g. Our Core Values"
                                    value="{{ old('values_heading', $pageData['values']['heading'] ?? '') }}">
                            </div>
                            <div class="col-md-5">
                                <label class="tz-label">Section Description</label>
                                <input type="text" name="values_description" class="form-control tz-input"
                                    placeholder="e.g. Six principles that guide every decision"
                                    value="{{ old('values_description', $pageData['values']['description'] ?? '') }}">
                            </div>
                        </div>

                        <hr class="tz-divider">
                        <p class="text-muted small fw-semibold mb-3">Value Cards (up to 6)</p>

                        @for ($i = 1; $i <= 6; $i++)
                            <div class="row g-3 mb-3 align-items-end">
                                <div class="col-auto d-flex align-items-center" style="padding-top:28px;">
                                    <span class="tz-step-badge">{{ $i }}</span>
                                </div>
                                <div class="col-md-3">
                                    <label class="tz-label">Icon Class</label>
                                    <input type="text" name="value_{{ $i }}_icon" class="form-control tz-input"
                                        placeholder="e.g. fa-shield-halved"
                                        value="{{ old('value_' . $i . '_icon', $pageData['values']['cards'][$i - 1]['icon'] ?? '') }}">
                                </div>
                                <div class="col-md-3">
                                    <label class="tz-label">Title</label>
                                    <input type="text" name="value_{{ $i }}_title" class="form-control tz-input"
                                        placeholder="e.g. 100% Genuine"
                                        value="{{ old('value_' . $i . '_title', $pageData['values']['cards'][$i - 1]['title'] ?? '') }}">
                                </div>
                                <div class="col">
                                    <label class="tz-label">Description</label>
                                    <input type="text" name="value_{{ $i }}_description" class="form-control tz-input"
                                        placeholder="e.g. Every product is sourced directly from authorized distributors..."
                                        value="{{ old('value_' . $i . '_description', $pageData['values']['cards'][$i - 1]['description'] ?? '') }}">
                                </div>
                            </div>
                            @if ($i < 6)
                            <hr class="tz-divider"> @endif
                        @endfor

                        <div class="tz-form-footer">
                            <button type="submit" class="btn btn-primary rounded-pill px-4">Save Core Values</button>
                        </div>
                    </form>
                </div>
            </div>

        
            <div class="tz-section-card mb-4">
                <div class="tz-section-header">
                    <div class="tz-section-label">
                        <span class="tz-section-icon bg-purple-soft text-purple">&#9200;</span>
                        <div>
                            <h5 class="fw-bold mb-0">Timeline / Journey Section</h5>
                            <p class="text-muted small mb-0">Badge, heading + up to 6 milestones (year, title, description)
                            </p>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('about.timeline.update') }}" method="POST">
                        @csrf

                        <div class="row g-3 mb-4">
                            <div class="col-md-3">
                                <label class="tz-label">Badge Text</label>
                                <input type="text" name="timeline_badge" class="form-control tz-input"
                                    placeholder="e.g. OUR JOURNEY"
                                    value="{{ old('timeline_badge', $pageData['timeline']['badge'] ?? '') }}">
                            </div>
                            <div class="col-md-9">
                                <label class="tz-label">Section Heading</label>
                                <input type="text" name="timeline_heading" class="form-control tz-input"
                                    placeholder="e.g. From Garage to 2M+ Customers"
                                    value="{{ old('timeline_heading', $pageData['timeline']['heading'] ?? '') }}">
                            </div>
                        </div>

                        <hr class="tz-divider">
                        <p class="text-muted small fw-semibold mb-3">Milestones (up to 6)</p>

                        @for ($i = 1; $i <= 6; $i++)
                            <div class="row g-3 mb-3 align-items-end">
                                <div class="col-auto d-flex align-items-center" style="padding-top:28px;">
                                    <span class="tz-step-badge">{{ $i }}</span>
                                </div>
                                <div class="col-md-2">
                                    <label class="tz-label">Year</label>
                                    <input type="text" name="milestone_{{ $i }}_year" class="form-control tz-input"
                                        placeholder="e.g. 2019"
                                        value="{{ old('milestone_' . $i . '_year', $pageData['timeline']['milestones'][$i - 1]['year'] ?? '') }}">
                                </div>
                                <div class="col-md-3">
                                    <label class="tz-label">Title</label>
                                    <input type="text" name="milestone_{{ $i }}_title" class="form-control tz-input"
                                        placeholder="e.g. TechZone Founded"
                                        value="{{ old('milestone_' . $i . '_title', $pageData['timeline']['milestones'][$i - 1]['title'] ?? '') }}">
                                </div>
                                <div class="col">
                                    <label class="tz-label">Description</label>
                                    <input type="text" name="milestone_{{ $i }}_description" class="form-control tz-input"
                                        placeholder="e.g. Started in a small garage with 50 products..."
                                        value="{{ old('milestone_' . $i . '_description', $pageData['timeline']['milestones'][$i - 1]['description'] ?? '') }}">
                                </div>
                            </div>
                            @if ($i < 6)
                            <hr class="tz-divider"> @endif
                        @endfor

                        <div class="tz-form-footer">
                            <button type="submit" class="btn btn-primary rounded-pill px-4">Save Timeline</button>
                        </div>
                    </form>
                </div>
            </div>


            <div class="tz-section-card mb-4">
                <div class="tz-section-header">
                    <div class="tz-section-label">
                        <span class="tz-section-icon bg-blue-soft text-primary">&#128100;</span>
                        <div>
                            <h5 class="fw-bold mb-0">Team Section</h5>
                            <p class="text-muted small mb-0">Section header + up to 6 team members (name, role, location,
                                social links)</p>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('about.team.update') }}" method="POST">
                        @csrf

                        <div class="row g-3 mb-4">
                            <div class="col-md-3">
                                <label class="tz-label">Badge Text</label>
                                <input type="text" name="team_badge" class="form-control tz-input"
                                    placeholder="e.g. THE TEAM"
                                    value="{{ old('team_badge', $pageData['team']['badge'] ?? '') }}">
                            </div>
                            <div class="col-md-4">
                                <label class="tz-label">Section Heading</label>
                                <input type="text" name="team_heading" class="form-control tz-input"
                                    placeholder="e.g. People Behind TechZone"
                                    value="{{ old('team_heading', $pageData['team']['heading'] ?? '') }}">
                            </div>
                            <div class="col-md-5">
                                <label class="tz-label">Section Description</label>
                                <input type="text" name="team_description" class="form-control tz-input"
                                    placeholder="e.g. Passionate engineers, designers, and operators..."
                                    value="{{ old('team_description', $pageData['team']['description'] ?? '') }}">
                            </div>
                        </div>

                        <hr class="tz-divider">
                        <p class="text-muted small fw-semibold mb-3">Team Members (up to 6)</p>

                        @for ($i = 1; $i <= 6; $i++)
                            <div class="row g-2 mb-3 align-items-end">
                                <div class="col-auto d-flex align-items-center" style="padding-top:28px;">
                                    <span class="tz-step-badge">{{ $i }}</span>
                                </div>
                                <div class="col-md-2">
                                    <label class="tz-label">Name</label>
                                    <input type="text" name="member_{{ $i }}_name" class="form-control tz-input"
                                        placeholder="e.g. Arjun Sharma"
                                        value="{{ old('member_' . $i . '_name', $pageData['team']['members'][$i - 1]['name'] ?? '') }}">
                                </div>
                                <div class="col-md-2">
                                    <label class="tz-label">Role</label>
                                    <input type="text" name="member_{{ $i }}_role" class="form-control tz-input"
                                        placeholder="e.g. CEO & Founder"
                                        value="{{ old('member_' . $i . '_role', $pageData['team']['members'][$i - 1]['role'] ?? '') }}">
                                </div>
                                <div class="col-md-2">
                                    <label class="tz-label">Location</label>
                                    <input type="text" name="member_{{ $i }}_location" class="form-control tz-input"
                                        placeholder="e.g. Mumbai, IN"
                                        value="{{ old('member_' . $i . '_location', $pageData['team']['members'][$i - 1]['location'] ?? '') }}">
                                </div>
                                <div class="col-md-2">
                                    <label class="tz-label">LinkedIn URL</label>
                                    <input type="text" name="member_{{ $i }}_linkedin" class="form-control tz-input"
                                        placeholder="https://linkedin.com/in/..."
                                        value="{{ old('member_' . $i . '_linkedin', $pageData['team']['members'][$i - 1]['linkedin'] ?? '') }}">
                                </div>
                                <div class="col">
                                    <label class="tz-label">Twitter / X URL</label>
                                    <input type="text" name="member_{{ $i }}_twitter" class="form-control tz-input"
                                        placeholder="https://x.com/..."
                                        value="{{ old('member_' . $i . '_twitter', $pageData['team']['members'][$i - 1]['twitter'] ?? '') }}">
                                </div>
                            </div>
                            @if ($i < 6)
                            <hr class="tz-divider"> @endif
                        @endfor

                        <div class="tz-form-footer">
                            <button type="submit" class="btn btn-primary rounded-pill px-4">Save Team Section</button>
                        </div>
                    </form>
                </div>
            </div>


            <div class="tz-section-card mb-4">
                <div class="tz-section-header">
                    <div class="tz-section-label">
                        <span class="tz-section-icon bg-warning-soft text-warning">&#127942;</span>
                        <div>
                            <h5 class="fw-bold mb-0">Awards & Achievements</h5>
                            <p class="text-muted small mb-0">Section header + up to 4 award tiles (icon, title, subtitle)
                            </p>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('about.awards.update') }}" method="POST">
                        @csrf

                        <div class="row g-3 mb-4">
                            <div class="col-md-3">
                                <label class="tz-label">Badge Text</label>
                                <input type="text" name="awards_badge" class="form-control tz-input"
                                    placeholder="e.g. RECOGNITION"
                                    value="{{ old('awards_badge', $pageData['awards']['badge'] ?? '') }}">
                            </div>
                            <div class="col-md-9">
                                <label class="tz-label">Section Heading</label>
                                <input type="text" name="awards_heading" class="form-control tz-input"
                                    placeholder="e.g. Awards & Achievements"
                                    value="{{ old('awards_heading', $pageData['awards']['heading'] ?? '') }}">
                            </div>
                        </div>

                        <hr class="tz-divider">
                        <p class="text-muted small fw-semibold mb-3">Award Tiles (up to 4)</p>

                        @for ($i = 1; $i <= 4; $i++)
                            <div class="row g-3 mb-3 align-items-end">
                                <div class="col-auto d-flex align-items-center" style="padding-top:28px;">
                                    <span class="tz-step-badge">{{ $i }}</span>
                                </div>
                                <div class="col-md-3">
                                    <label class="tz-label">Icon Class</label>
                                    <input type="text" name="award_{{ $i }}_icon" class="form-control tz-input"
                                        placeholder="e.g. fa-trophy"
                                        value="{{ old('award_' . $i . '_icon', $pageData['awards']['items'][$i - 1]['icon'] ?? '') }}">
                                </div>
                                <div class="col-md-4">
                                    <label class="tz-label">Title</label>
                                    <input type="text" name="award_{{ $i }}_title" class="form-control tz-input"
                                        placeholder="e.g. Best E-Commerce 2023"
                                        value="{{ old('award_' . $i . '_title', $pageData['awards']['items'][$i - 1]['title'] ?? '') }}">
                                </div>
                                <div class="col">
                                    <label class="tz-label">Subtitle / Source</label>
                                    <input type="text" name="award_{{ $i }}_subtitle" class="form-control tz-input"
                                        placeholder="e.g. Economic Times Retail Awards"
                                        value="{{ old('award_' . $i . '_subtitle', $pageData['awards']['items'][$i - 1]['subtitle'] ?? '') }}">
                                </div>
                            </div>
                            @if ($i < 4)
                            <hr class="tz-divider"> @endif
                        @endfor

                        <div class="tz-form-footer">
                            <button type="submit" class="btn btn-primary rounded-pill px-4">Save Awards</button>
                        </div>
                    </form>
                </div>
            </div>

        
            <div class="tz-section-card mb-4">
                <div class="tz-section-header">
                    <div class="tz-section-label">
                        <span class="tz-section-icon bg-danger-soft text-danger">&#128640;</span>
                        <div>
                            <h5 class="fw-bold mb-0">CTA Section</h5>
                            <p class="text-muted small mb-0">"Ready to Shop Smarter?" — badge, heading, description, two
                                buttons</p>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('about.cta.update') }}" method="POST">
                        @csrf

                        <div class="row g-3">
                            <div class="col-md-3">
                                <label class="tz-label">Badge Text</label>
                                <input type="text" name="cta_badge" class="form-control tz-input"
                                    placeholder="e.g. GET STARTED"
                                    value="{{ old('cta_badge', $pageData['cta']['badge'] ?? '') }}">
                            </div>
                            <div class="col-md-9">
                                <label class="tz-label">Heading</label>
                                <input type="text" name="cta_heading" class="form-control tz-input"
                                    placeholder="e.g. Ready to Shop Smarter?"
                                    value="{{ old('cta_heading', $pageData['cta']['heading'] ?? '') }}">
                            </div>
                            <div class="col-12">
                                <label class="tz-label">Description</label>
                                <textarea name="cta_description" rows="2" class="form-control tz-input"
                                    placeholder="Join 2 million+ Indians who trust TechZone...">{{ old('cta_description', $pageData['cta']['description'] ?? '') }}</textarea>
                            </div>
                            <div class="col-md-3">
                                <label class="tz-label">Primary Button Text</label>
                                <input type="text" name="cta_btn1_text" class="form-control tz-input"
                                    placeholder="e.g. Explore Products"
                                    value="{{ old('cta_btn1_text', $pageData['cta']['btn1_text'] ?? '') }}">
                            </div>
                            <div class="col-md-3">
                                <label class="tz-label">Primary Button Link</label>
                                <input type="text" name="cta_btn1_link" class="form-control tz-input"
                                    placeholder="/products"
                                    value="{{ old('cta_btn1_link', $pageData['cta']['btn1_link'] ?? '') }}">
                            </div>
                            <div class="col-md-3">
                                <label class="tz-label">Secondary Button Text</label>
                                <input type="text" name="cta_btn2_text" class="form-control tz-input"
                                    placeholder="e.g. Talk to Us"
                                    value="{{ old('cta_btn2_text', $pageData['cta']['btn2_text'] ?? '') }}">
                            </div>
                            <div class="col-md-3">
                                <label class="tz-label">Secondary Button Link</label>
                                <input type="text" name="cta_btn2_link" class="form-control tz-input" placeholder="/contact"
                                    value="{{ old('cta_btn2_link', $pageData['cta']['btn2_link'] ?? '') }}">
                            </div>
                        </div>

                        <div class="tz-form-footer">
                            <button type="submit" class="btn btn-primary rounded-pill px-4">Save CTA Section</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>

    
        <style>
            .tz-admin-page {
                background: #f4f6fb;
                min-height: 100vh;
            }

            .tz-section-card {
                background: #fff;
                border-radius: 20px;
                border: 1px solid #eaecf4;
                overflow: hidden;
                box-shadow: 0 1px 4px rgba(0, 0, 0, .04);
            }

            .tz-section-header {
                padding: 20px 24px;
                border-bottom: 1px solid #f0f2f8;
                background: #fcfcff;
            }

            .tz-section-label {
                display: flex;
                align-items: center;
                gap: 14px;
            }

            .tz-section-icon {
                width: 42px;
                height: 42px;
                border-radius: 12px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.1rem;
                flex-shrink: 0;
            }

            .bg-blue-soft {
                background: #e8f0fe;
            }

            .bg-success-soft {
                background: #e6f7ee;
            }

            .bg-warning-soft {
                background: #fff8e1;
            }

            .bg-danger-soft {
                background: #fce8e8;
            }

            .bg-purple-soft {
                background: #f0ebff;
            }

            .bg-info-soft {
                background: #e3f6fd;
            }

            .text-purple {
                color: #6f42c1 !important;
            }

            .tz-label {
                display: block;
                font-size: .8rem;
                font-weight: 600;
                color: #4b5568;
                margin-bottom: 6px;
                letter-spacing: .1px;
            }

            .tz-input {
                border-radius: 12px;
                border: 1.5px solid #e5e8f0;
                padding: 10px 14px;
                font-size: .875rem;
                color: #1a202c;
                transition: border-color .2s, box-shadow .2s;
                box-shadow: none !important;
                background: #fff;
            }

            .tz-input:focus {
                border-color: #4f46e5;
                box-shadow: 0 0 0 3px rgba(79, 70, 229, .08) !important;
            }

            .tz-input::placeholder {
                color: #a0aec0;
            }

            .tz-sub-section {
                background: #f9faff;
                border-radius: 14px;
                padding: 16px 20px;
                border: 1px solid #eaecf4;
            }

            .tz-form-footer {
                margin-top: 20px;
                padding-top: 16px;
                border-top: 1px solid #f0f2f8;
                display: flex;
                justify-content: flex-end;
            }

            .tz-divider {
                border-color: #f0f2f8;
                margin: 16px 0;
            }

            .tz-step-badge {
                width: 30px;
                height: 30px;
                border-radius: 50%;
                background: #eef2ff;
                color: #4f46e5;
                font-weight: 700;
                font-size: .8rem;
                display: flex;
                align-items: center;
                justify-content: center;
                flex-shrink: 0;
            }

            .tz-preview-card {
                background: #f8f9fc;
                border: 1.5px solid #eaecf4;
                border-radius: 16px;
                padding: 16px;
            }
        </style>

    </x-app-layout>