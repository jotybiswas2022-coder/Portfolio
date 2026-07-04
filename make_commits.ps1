# PowerShell script to make 83 safe, meaningful commits
$ErrorActionPreference = 'Stop'
$enc = [System.Text.UTF8Encoding]::new($false)

function Make-Commit {
    param($Message)
    git add -A
    git commit -m "$Message"
    if ($LASTEXITCODE -ne 0) { Write-Warning "Empty commit? $Message" }
}

function Replace-InFile {
    param($Path, $Pattern, $Replacement)
    $fullPath = (Resolve-Path $Path).Path
    $c = [System.IO.File]::ReadAllText($fullPath)
    $new = $c -replace $Pattern, $Replacement
    if ($c -eq $new) { Write-Warning "NO CHANGE: $Pattern in $Path" }
    [System.IO.File]::WriteAllText($fullPath, $new, $enc)
}

Write-Host "=== Starting 83 commits ==="

# ===== MODELS: RETURN TYPES =====

# 1
Replace-InFile -Path 'app\Models\Project.php' -Pattern 'protected static function booted\(\)' -Replacement 'protected static function booted(): void'
Make-Commit 'Add void return type to Project::booted()'

# 2
Replace-InFile -Path 'app\Models\Project.php' -Pattern 'public function scopeActive\(\$query\)' -Replacement 'public function scopeActive($$query): \Illuminate\Database\Eloquent\Builder'
Make-Commit 'Add Builder return type to Project::scopeActive()'

# 3
Replace-InFile -Path 'app\Models\Skill.php' -Pattern 'public function scopeActive\(\$query\)' -Replacement 'public function scopeActive($$query): \Illuminate\Database\Eloquent\Builder'
Make-Commit 'Add Builder return type to Skill::scopeActive()'

# 4
Replace-InFile -Path 'app\Models\Service.php' -Pattern 'public function scopeActive\(\$query\)' -Replacement 'public function scopeActive($$query): \Illuminate\Database\Eloquent\Builder'
Make-Commit 'Add Builder return type to Service::scopeActive()'

# 5
Replace-InFile -Path 'app\Models\Faq.php' -Pattern 'public function scopeActive\(\$query\)' -Replacement 'public function scopeActive($$query): \Illuminate\Database\Eloquent\Builder'
Make-Commit 'Add Builder return type to Faq::scopeActive()'

# 6
Replace-InFile -Path 'app\Models\CaseStudy.php' -Pattern 'public function scopeActive\(\$query\)' -Replacement 'public function scopeActive($$query): \Illuminate\Database\Eloquent\Builder'
Make-Commit 'Add Builder return type to CaseStudy::scopeActive()'

# 7
Replace-InFile -Path 'app\Models\Gig.php' -Pattern 'public function scopeActive\(\$query\)' -Replacement 'public function scopeActive($$query): \Illuminate\Database\Eloquent\Builder'
Make-Commit 'Add Builder return type to Gig::scopeActive()'

# 8
Replace-InFile -Path 'app\Models\Experience.php' -Pattern 'public function scopeActive\(\$query\)' -Replacement 'public function scopeActive($$query): \Illuminate\Database\Eloquent\Builder'
Make-Commit 'Add Builder return type to Experience::scopeActive()'

# 9
Replace-InFile -Path 'app\Models\Testimonial.php' -Pattern 'public function scopeActive\(\$query\)' -Replacement 'public function scopeActive($$query): \Illuminate\Database\Eloquent\Builder'
Make-Commit 'Add Builder return type to Testimonial::scopeActive()'

Write-Host 'Models DONE (9)'

# ===== CONTROLLERS: RETURN TYPES =====

# 10-13: SiteController (4 methods)
Replace-InFile -Path 'app\Http\Controllers\SiteController.php' -Pattern 'public function index\(\)\{' -Replacement 'public function index(): \Illuminate\View\View{'
Make-Commit 'Add View return type to SiteController::index()'

# 11
Replace-InFile -Path 'app\Http\Controllers\SiteController.php' -Pattern 'public function gigDetail\(\$id\)\{' -Replacement 'public function gigDetail($$id): \Illuminate\View\View{'
Make-Commit 'Add View return type to SiteController::gigDetail()'

# 12
Replace-InFile -Path 'app\Http\Controllers\SiteController.php' -Pattern 'public function caseStudyDetail\(\$id\)\{' -Replacement 'public function caseStudyDetail($$id): \Illuminate\View\View{'
Make-Commit 'Add View return type to SiteController::caseStudyDetail()'

# 13
Replace-InFile -Path 'app\Http\Controllers\SiteController.php' -Pattern 'public function projectDetail\(\$id\)\{' -Replacement 'public function projectDetail($$id): \Illuminate\View\View{'
Make-Commit 'Add View return type to SiteController::projectDetail()'

# 14: DashboardController
Replace-InFile -Path 'app\Http\Controllers\admin\DashboardController.php' -Pattern 'public function index\(\)' -Replacement 'public function index(): \Illuminate\View\View'
Make-Commit 'Add View return type to DashboardController::index()'

# 15-18: AccountController (4 methods)
Replace-InFile -Path 'app\Http\Controllers\admin\AccountController.php' -Pattern 'public function index\(\)' -Replacement 'public function index(): \Illuminate\View\View'
Make-Commit 'Add View return type to AccountController::index()'

# 16
Replace-InFile -Path 'app\Http\Controllers\admin\AccountController.php' -Pattern 'public function edit\(\)' -Replacement 'public function edit(): \Illuminate\View\View'
Make-Commit 'Add View return type to AccountController::edit()'

# 17
Replace-InFile -Path 'app\Http\Controllers\admin\AccountController.php' -Pattern 'public function update\(Request \$request\)' -Replacement 'public function update(Request $$request): \Illuminate\Http\RedirectResponse'
Make-Commit 'Add RedirectResponse return type to AccountController::update()'

# 18
Replace-InFile -Path 'app\Http\Controllers\admin\AccountController.php' -Pattern 'public function deleteImage\(\)' -Replacement 'public function deleteImage(): \Illuminate\Http\RedirectResponse'
Make-Commit 'Add RedirectResponse return type to AccountController::deleteImage()'

# 19: ContactController
Replace-InFile -Path 'app\Http\Controllers\admin\ContactController.php' -Pattern 'function index\(\)\{' -Replacement 'function index(): \Illuminate\View\View{'
Make-Commit 'Add View return type to ContactController::index()'

# 20-27: CaseStudyController (8 methods)
Replace-InFile -Path 'app\Http\Controllers\admin\CaseStudyController.php' -Pattern 'public function index\(Request \$request\)' -Replacement 'public function index(Request $$request): \Illuminate\View\View|\Illuminate\Http\JsonResponse'
Make-Commit 'Add return type to CaseStudyController::index()'

# 21
Replace-InFile -Path 'app\Http\Controllers\admin\CaseStudyController.php' -Pattern 'public function create\(\)' -Replacement 'public function create(): \Illuminate\View\View'
Make-Commit 'Add View return type to CaseStudyController::create()'

# 22
Replace-InFile -Path 'app\Http\Controllers\admin\CaseStudyController.php' -Pattern 'public function store\(Request \$request\)' -Replacement 'public function store(Request $$request): \Illuminate\Http\RedirectResponse'
Make-Commit 'Add RedirectResponse return type to CaseStudyController::store()'

# 23
Replace-InFile -Path 'app\Http\Controllers\admin\CaseStudyController.php' -Pattern 'public function edit\(\$id\)' -Replacement 'public function edit($$id): \Illuminate\View\View'
Make-Commit 'Add View return type to CaseStudyController::edit()'

# 24
Replace-InFile -Path 'app\Http\Controllers\admin\CaseStudyController.php' -Pattern 'public function update\(Request \$request, \$id\)' -Replacement 'public function update(Request $$request, $$id): \Illuminate\Http\RedirectResponse'
Make-Commit 'Add RedirectResponse return type to CaseStudyController::update()'

# 25
Replace-InFile -Path 'app\Http\Controllers\admin\CaseStudyController.php' -Pattern 'public function destroy\(\$id\)' -Replacement 'public function destroy($$id): \Illuminate\Http\RedirectResponse'
Make-Commit 'Add RedirectResponse return type to CaseStudyController::destroy()'

# 26
Replace-InFile -Path 'app\Http\Controllers\admin\CaseStudyController.php' -Pattern 'public function deleteImage\(\$id\)' -Replacement 'public function deleteImage($$id): \Illuminate\Http\RedirectResponse'
Make-Commit 'Add RedirectResponse return type to CaseStudyController::deleteImage()'

# 27
Replace-InFile -Path 'app\Http\Controllers\admin\CaseStudyController.php' -Pattern 'public function toggleStatus\(\$id\)' -Replacement 'public function toggleStatus($$id): \Illuminate\Http\RedirectResponse'
Make-Commit 'Add RedirectResponse return type to CaseStudyController::toggleStatus()'

# 28-34: ExperienceController (7 methods)
Replace-InFile -Path 'app\Http\Controllers\admin\ExperienceController.php' -Pattern 'public function index\(Request \$request\)' -Replacement 'public function index(Request $$request): \Illuminate\View\View|\Illuminate\Http\JsonResponse'
Make-Commit 'Add return type to ExperienceController::index()'

# 29
Replace-InFile -Path 'app\Http\Controllers\admin\ExperienceController.php' -Pattern 'public function create\(\)' -Replacement 'public function create(): \Illuminate\View\View'
Make-Commit 'Add View return type to ExperienceController::create()'

# 30
Replace-InFile -Path 'app\Http\Controllers\admin\ExperienceController.php' -Pattern 'public function store\(Request \$request\)' -Replacement 'public function store(Request $$request): \Illuminate\Http\RedirectResponse'
Make-Commit 'Add RedirectResponse return type to ExperienceController::store()'

# 31
Replace-InFile -Path 'app\Http\Controllers\admin\ExperienceController.php' -Pattern 'public function edit\(\$id\)' -Replacement 'public function edit($$id): \Illuminate\View\View'
Make-Commit 'Add View return type to ExperienceController::edit()'

# 32
Replace-InFile -Path 'app\Http\Controllers\admin\ExperienceController.php' -Pattern 'public function update\(Request \$request, \$id\)' -Replacement 'public function update(Request $$request, $$id): \Illuminate\Http\RedirectResponse'
Make-Commit 'Add RedirectResponse return type to ExperienceController::update()'

# 33
Replace-InFile -Path 'app\Http\Controllers\admin\ExperienceController.php' -Pattern 'public function destroy\(\$id\)' -Replacement 'public function destroy($$id): \Illuminate\Http\RedirectResponse'
Make-Commit 'Add RedirectResponse return type to ExperienceController::destroy()'

# 34
Replace-InFile -Path 'app\Http\Controllers\admin\ExperienceController.php' -Pattern 'public function toggleStatus\(\$id\)' -Replacement 'public function toggleStatus($$id): \Illuminate\Http\RedirectResponse'
Make-Commit 'Add RedirectResponse return type to ExperienceController::toggleStatus()'

# 35-41: FaqController (7 methods)
Replace-InFile -Path 'app\Http\Controllers\admin\FaqController.php' -Pattern 'public function index\(Request \$request\)' -Replacement 'public function index(Request $$request): \Illuminate\View\View|\Illuminate\Http\JsonResponse'
Make-Commit 'Add return type to FaqController::index()'

# 36
Replace-InFile -Path 'app\Http\Controllers\admin\FaqController.php' -Pattern 'public function create\(\)' -Replacement 'public function create(): \Illuminate\View\View'
Make-Commit 'Add View return type to FaqController::create()'

# 37
Replace-InFile -Path 'app\Http\Controllers\admin\FaqController.php' -Pattern 'public function store\(Request \$request\)' -Replacement 'public function store(Request $$request): \Illuminate\Http\RedirectResponse'
Make-Commit 'Add RedirectResponse return type to FaqController::store()'

# 38
Replace-InFile -Path 'app\Http\Controllers\admin\FaqController.php' -Pattern 'public function edit\(\$id\)' -Replacement 'public function edit($$id): \Illuminate\View\View'
Make-Commit 'Add View return type to FaqController::edit()'

# 39
Replace-InFile -Path 'app\Http\Controllers\admin\FaqController.php' -Pattern 'public function update\(Request \$request, \$id\)' -Replacement 'public function update(Request $$request, $$id): \Illuminate\Http\RedirectResponse'
Make-Commit 'Add RedirectResponse return type to FaqController::update()'

# 40
Replace-InFile -Path 'app\Http\Controllers\admin\FaqController.php' -Pattern 'public function destroy\(\$id\)' -Replacement 'public function destroy($$id): \Illuminate\Http\RedirectResponse'
Make-Commit 'Add RedirectResponse return type to FaqController::destroy()'

# 41
Replace-InFile -Path 'app\Http\Controllers\admin\FaqController.php' -Pattern 'public function toggleStatus\(\$id\)' -Replacement 'public function toggleStatus($$id): \Illuminate\Http\RedirectResponse'
Make-Commit 'Add RedirectResponse return type to FaqController::toggleStatus()'

# 42-49: GigController (8 methods)
Replace-InFile -Path 'app\Http\Controllers\admin\GigController.php' -Pattern 'public function index\(Request \$request\)' -Replacement 'public function index(Request $$request): \Illuminate\View\View|\Illuminate\Http\JsonResponse'
Make-Commit 'Add return type to GigController::index()'

# 43
Replace-InFile -Path 'app\Http\Controllers\admin\GigController.php' -Pattern 'public function create\(\)' -Replacement 'public function create(): \Illuminate\View\View'
Make-Commit 'Add View return type to GigController::create()'

# 44
Replace-InFile -Path 'app\Http\Controllers\admin\GigController.php' -Pattern 'public function store\(Request \$request\)' -Replacement 'public function store(Request $$request): \Illuminate\Http\RedirectResponse'
Make-Commit 'Add RedirectResponse return type to GigController::store()'

# 45
Replace-InFile -Path 'app\Http\Controllers\admin\GigController.php' -Pattern 'public function edit\(\$id\)' -Replacement 'public function edit($$id): \Illuminate\View\View'
Make-Commit 'Add View return type to GigController::edit()'

# 46
Replace-InFile -Path 'app\Http\Controllers\admin\GigController.php' -Pattern 'public function update\(Request \$request, \$id\)' -Replacement 'public function update(Request $$request, $$id): \Illuminate\Http\RedirectResponse'
Make-Commit 'Add RedirectResponse return type to GigController::update()'

# 47
Replace-InFile -Path 'app\Http\Controllers\admin\GigController.php' -Pattern 'public function destroy\(\$id\)' -Replacement 'public function destroy($$id): \Illuminate\Http\RedirectResponse'
Make-Commit 'Add RedirectResponse return type to GigController::destroy()'

# 48
Replace-InFile -Path 'app\Http\Controllers\admin\GigController.php' -Pattern 'public function deleteImage\(\$id\)' -Replacement 'public function deleteImage($$id): \Illuminate\Http\RedirectResponse'
Make-Commit 'Add RedirectResponse return type to GigController::deleteImage()'

# 49
Replace-InFile -Path 'app\Http\Controllers\admin\GigController.php' -Pattern 'public function toggleStatus\(\$id\)' -Replacement 'public function toggleStatus($$id): \Illuminate\Http\RedirectResponse'
Make-Commit 'Add RedirectResponse return type to GigController::toggleStatus()'

# 50-52: admin InboxController (3 methods)
Replace-InFile -Path 'app\Http\Controllers\admin\InboxController.php' -Pattern 'public function index\(\)' -Replacement 'public function index(): \Illuminate\View\View'
Make-Commit 'Add View return type to admin InboxController::index()'

# 51
Replace-InFile -Path 'app\Http\Controllers\admin\InboxController.php' -Pattern 'public function show\(\$id\)' -Replacement 'public function show($$id): \Illuminate\View\View'
Make-Commit 'Add View return type to admin InboxController::show()'

# 52
Replace-InFile -Path 'app\Http\Controllers\admin\InboxController.php' -Pattern 'public function sendMessage\(Request \$request, \$id\)' -Replacement 'public function sendMessage(Request $$request, $$id): \Illuminate\Http\RedirectResponse'
Make-Commit 'Add RedirectResponse return type to admin InboxController::sendMessage()'

# 53-60: ProjectController (8 methods)
Replace-InFile -Path 'app\Http\Controllers\admin\ProjectController.php' -Pattern 'public function index\(Request \$request\)' -Replacement 'public function index(Request $$request): \Illuminate\View\View|\Illuminate\Http\JsonResponse'
Make-Commit 'Add return type to ProjectController::index()'

# 54
Replace-InFile -Path 'app\Http\Controllers\admin\ProjectController.php' -Pattern 'public function create\(\)' -Replacement 'public function create(): \Illuminate\View\View'
Make-Commit 'Add View return type to ProjectController::create()'

# 55
Replace-InFile -Path 'app\Http\Controllers\admin\ProjectController.php' -Pattern 'public function store\(Request \$request\)' -Replacement 'public function store(Request $$request): \Illuminate\Http\RedirectResponse'
Make-Commit 'Add RedirectResponse return type to ProjectController::store()'

# 56
Replace-InFile -Path 'app\Http\Controllers\admin\ProjectController.php' -Pattern 'public function edit\(\$id\)' -Replacement 'public function edit($$id): \Illuminate\View\View'
Make-Commit 'Add View return type to ProjectController::edit()'

# 57
Replace-InFile -Path 'app\Http\Controllers\admin\ProjectController.php' -Pattern 'public function update\(Request \$request, \$id\)' -Replacement 'public function update(Request $$request, $$id): \Illuminate\Http\RedirectResponse'
Make-Commit 'Add RedirectResponse return type to ProjectController::update()'

# 58
Replace-InFile -Path 'app\Http\Controllers\admin\ProjectController.php' -Pattern 'public function destroy\(\$id\)' -Replacement 'public function destroy($$id): \Illuminate\Http\RedirectResponse'
Make-Commit 'Add RedirectResponse return type to ProjectController::destroy()'

# 59
Replace-InFile -Path 'app\Http\Controllers\admin\ProjectController.php' -Pattern 'public function deleteImage\(\$id\)' -Replacement 'public function deleteImage($$id): \Illuminate\Http\RedirectResponse'
Make-Commit 'Add RedirectResponse return type to ProjectController::deleteImage()'

# 60
Replace-InFile -Path 'app\Http\Controllers\admin\ProjectController.php' -Pattern 'public function toggleStatus\(\$id\)' -Replacement 'public function toggleStatus($$id): \Illuminate\Http\RedirectResponse'
Make-Commit 'Add RedirectResponse return type to ProjectController::toggleStatus()'

# 61-67: ServiceController (7 methods)
Replace-InFile -Path 'app\Http\Controllers\admin\ServiceController.php' -Pattern 'public function index\(Request \$request\)' -Replacement 'public function index(Request $$request): \Illuminate\View\View|\Illuminate\Http\JsonResponse'
Make-Commit 'Add return type to ServiceController::index()'

# 62
Replace-InFile -Path 'app\Http\Controllers\admin\ServiceController.php' -Pattern 'public function create\(\)' -Replacement 'public function create(): \Illuminate\View\View'
Make-Commit 'Add View return type to ServiceController::create()'

# 63
Replace-InFile -Path 'app\Http\Controllers\admin\ServiceController.php' -Pattern 'public function store\(Request \$request\)' -Replacement 'public function store(Request $$request): \Illuminate\Http\RedirectResponse'
Make-Commit 'Add RedirectResponse return type to ServiceController::store()'

# 64
Replace-InFile -Path 'app\Http\Controllers\admin\ServiceController.php' -Pattern 'public function edit\(\$id\)' -Replacement 'public function edit($$id): \Illuminate\View\View'
Make-Commit 'Add View return type to ServiceController::edit()'

# 65
Replace-InFile -Path 'app\Http\Controllers\admin\ServiceController.php' -Pattern 'public function update\(Request \$request, \$id\)' -Replacement 'public function update(Request $$request, $$id): \Illuminate\Http\RedirectResponse'
Make-Commit 'Add RedirectResponse return type to ServiceController::update()'

# 66
Replace-InFile -Path 'app\Http\Controllers\admin\ServiceController.php' -Pattern 'public function destroy\(\$id\)' -Replacement 'public function destroy($$id): \Illuminate\Http\RedirectResponse'
Make-Commit 'Add RedirectResponse return type to ServiceController::destroy()'

# 67
Replace-InFile -Path 'app\Http\Controllers\admin\ServiceController.php' -Pattern 'public function toggleStatus\(\$id\)' -Replacement 'public function toggleStatus($$id): \Illuminate\Http\RedirectResponse'
Make-Commit 'Add RedirectResponse return type to ServiceController::toggleStatus()'

# 68-74: SkillController (7 methods)
Replace-InFile -Path 'app\Http\Controllers\admin\SkillController.php' -Pattern 'public function index\(Request \$request\)' -Replacement 'public function index(Request $$request): \Illuminate\View\View|\Illuminate\Http\JsonResponse'
Make-Commit 'Add return type to SkillController::index()'

# 69
Replace-InFile -Path 'app\Http\Controllers\admin\SkillController.php' -Pattern 'public function create\(\)' -Replacement 'public function create(): \Illuminate\View\View'
Make-Commit 'Add View return type to SkillController::create()'

# 70
Replace-InFile -Path 'app\Http\Controllers\admin\SkillController.php' -Pattern 'public function store\(Request \$request\)' -Replacement 'public function store(Request $$request): \Illuminate\Http\RedirectResponse'
Make-Commit 'Add RedirectResponse return type to SkillController::store()'

# 71
Replace-InFile -Path 'app\Http\Controllers\admin\SkillController.php' -Pattern 'public function edit\(\$id\)' -Replacement 'public function edit($$id): \Illuminate\View\View'
Make-Commit 'Add View return type to SkillController::edit()'

# 72
Replace-InFile -Path 'app\Http\Controllers\admin\SkillController.php' -Pattern 'public function update\(Request \$request, \$id\)' -Replacement 'public function update(Request $$request, $$id): \Illuminate\Http\RedirectResponse'
Make-Commit 'Add RedirectResponse return type to SkillController::update()'

# 73
Replace-InFile -Path 'app\Http\Controllers\admin\SkillController.php' -Pattern 'public function destroy\(\$id\)' -Replacement 'public function destroy($$id): \Illuminate\Http\RedirectResponse'
Make-Commit 'Add RedirectResponse return type to SkillController::destroy()'

# 74
Replace-InFile -Path 'app\Http\Controllers\admin\SkillController.php' -Pattern 'public function toggleStatus\(\$id\)' -Replacement 'public function toggleStatus($$id): \Illuminate\Http\RedirectResponse'
Make-Commit 'Add RedirectResponse return type to SkillController::toggleStatus()'

# 75-82: TestimonialController (8 methods)
Replace-InFile -Path 'app\Http\Controllers\admin\TestimonialController.php' -Pattern 'public function index\(Request \$request\)' -Replacement 'public function index(Request $$request): \Illuminate\View\View|\Illuminate\Http\JsonResponse'
Make-Commit 'Add return type to TestimonialController::index()'

# 76
Replace-InFile -Path 'app\Http\Controllers\admin\TestimonialController.php' -Pattern 'public function create\(\)' -Replacement 'public function create(): \Illuminate\View\View'
Make-Commit 'Add View return type to TestimonialController::create()'

# 77
Replace-InFile -Path 'app\Http\Controllers\admin\TestimonialController.php' -Pattern 'public function store\(Request \$request\)' -Replacement 'public function store(Request $$request): \Illuminate\Http\RedirectResponse'
Make-Commit 'Add RedirectResponse return type to TestimonialController::store()'

# 78
Replace-InFile -Path 'app\Http\Controllers\admin\TestimonialController.php' -Pattern 'public function edit\(\$id\)' -Replacement 'public function edit($$id): \Illuminate\View\View'
Make-Commit 'Add View return type to TestimonialController::edit()'

# 79
Replace-InFile -Path 'app\Http\Controllers\admin\TestimonialController.php' -Pattern 'public function update\(Request \$request, \$id\)' -Replacement 'public function update(Request $$request, $$id): \Illuminate\Http\RedirectResponse'
Make-Commit 'Add RedirectResponse return type to TestimonialController::update()'

# 80
Replace-InFile -Path 'app\Http\Controllers\admin\TestimonialController.php' -Pattern 'public function destroy\(\$id\)' -Replacement 'public function destroy($$id): \Illuminate\Http\RedirectResponse'
Make-Commit 'Add RedirectResponse return type to TestimonialController::destroy()'

# 81
Replace-InFile -Path 'app\Http\Controllers\admin\TestimonialController.php' -Pattern 'public function deleteImage\(\$id\)' -Replacement 'public function deleteImage($$id): \Illuminate\Http\RedirectResponse'
Make-Commit 'Add RedirectResponse return type to TestimonialController::deleteImage()'

# 82
Replace-InFile -Path 'app\Http\Controllers\admin\TestimonialController.php' -Pattern 'public function toggleStatus\(\$id\)' -Replacement 'public function toggleStatus($$id): \Illuminate\Http\RedirectResponse'
Make-Commit 'Add RedirectResponse return type to TestimonialController::toggleStatus()'

# 83: UserController contactus
Replace-InFile -Path 'app\Http\Controllers\user\UserController.php' -Pattern 'public function contactus\(Request \$request\)' -Replacement 'public function contactus(Request $$request): \Illuminate\Http\RedirectResponse'
Make-Commit 'Add RedirectResponse return type to UserController::contactus()'

Write-Host "=== All 83 commits completed! ==="
Write-Host "Run: git push origin main"
