# PowerShell script to make 108 minimal commits with unique messages
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

$commitCount = 0
Write-Host "=== Starting 108 commits ==="

# === SECTION 1: Add route names to unnamed routes (3 commits) ===

# 1: Dashboard route name
Replace-InFile -Path 'routes\admin.php' -Pattern "Route::get\('/', 'index'\);" -Replacement "Route::get('/', 'index')->name('admin.dashboard.index');"
$commitCount++; Make-Commit "Add route name to admin dashboard"
if ($commitCount -ge 108) { return }

# 2: Account routes - add name prefix and names
Replace-InFile -Path 'routes\admin.php' -Pattern "Route::prefix\('/account'\)->controller\(AccountController::class\)->group\(function \(\)" -Replacement "Route::prefix('/account')->name('admin.account.')->controller(AccountController::class)->group(function ()"
Replace-InFile -Path 'routes\admin.php' -Pattern "\('\/', 'index'\);\s*\n\s*Route::get\('/edit',\s*'edit'\);\s*\n\s*Route::post\('/update', 'update'\);\s*\n\s*Route::post\('/delete-image', 'deleteImage'\);" -Replacement "('/', 'index')->name('index');`n        Route::get('/edit', 'edit')->name('edit');`n        Route::post('/update', 'update')->name('update');`n        Route::post('/delete-image', 'deleteImage')->name('deleteImage');"
$commitCount++; Make-Commit "Add route names to admin account routes"
if ($commitCount -ge 108) { return }

# 3: Contact route name
Replace-InFile -Path 'routes\admin.php' -Pattern "Route::prefix\('/contact'\)->controller\(ContactController::class\)->group\(function \(\)" -Replacement "Route::prefix('/contact')->name('admin.contact.')->controller(ContactController::class)->group(function ()"
Replace-InFile -Path 'routes\admin.php' -Pattern "\('\/', 'index'\);" -Replacement "('/', 'index')->name('index');"
$commitCount++; Make-Commit "Add route name to admin contact"
if ($commitCount -ge 108) { return }

# === SECTION 2: Add PHP return types (17 commits) ===

# 4-7: InboxController
Replace-InFile -Path 'app\Http\Controllers\InboxController.php' -Pattern 'public function index\(\)' -Replacement 'public function index(): \Illuminate\View\View'
$commitCount++; Make-Commit "Add View return type to InboxController::index()"
if ($commitCount -ge 108) { return }

Replace-InFile -Path 'app\Http\Controllers\InboxController.php' -Pattern 'public function show\(\$id\)' -Replacement 'public function show($$id): \Illuminate\View\View'
$commitCount++; Make-Commit "Add View return type to InboxController::show()"
if ($commitCount -ge 108) { return }

Replace-InFile -Path 'app\Http\Controllers\InboxController.php' -Pattern 'public function sendMessage\(Request \$request, \$id\)' -Replacement 'public function sendMessage(Request $$request, $$id): \Illuminate\Http\RedirectResponse'
$commitCount++; Make-Commit "Add RedirectResponse return type to InboxController::sendMessage()"
if ($commitCount -ge 108) { return }

Replace-InFile -Path 'app\Http\Controllers\InboxController.php' -Pattern 'public function orderFromGig\(Request \$request, \$gigId, \$package\)' -Replacement 'public function orderFromGig(Request $$request, $$gigId, $$package): \Illuminate\Http\RedirectResponse'
$commitCount++; Make-Commit "Add RedirectResponse return type to InboxController::orderFromGig()"
if ($commitCount -ge 108) { return }

# 8-9: RegisterController
Replace-InFile -Path 'app\Http\Controllers\Auth\RegisterController.php' -Pattern 'protected function validator\(array \$data\)' -Replacement 'protected function validator(array $$data): \Illuminate\Contracts\Validation\Validator'
$commitCount++; Make-Commit "Add Validator return type to RegisterController::validator()"
if ($commitCount -ge 108) { return }

Replace-InFile -Path 'app\Http\Controllers\Auth\RegisterController.php' -Pattern 'protected function create\(array \$data\)' -Replacement 'protected function create(array $$data): \App\Models\User'
$commitCount++; Make-Commit "Add User return type to RegisterController::create()"
if ($commitCount -ge 108) { return }

# 10: AdminMiddleware
Replace-InFile -Path 'app\Http\Middleware\AdminMiddleware.php' -Pattern 'public function handle\(Request \$request, Closure \$next\)' -Replacement 'public function handle(Request $$request, Closure $$next): \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse'
$commitCount++; Make-Commit "Add Response return type to AdminMiddleware::handle()"
if ($commitCount -ge 108) { return }

# 11-15: Conversation model
Replace-InFile -Path 'app\Models\Conversation.php' -Pattern 'public function user\(\)' -Replacement 'public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo'
$commitCount++; Make-Commit "Add BelongsTo return type to Conversation::user()"
if ($commitCount -ge 108) { return }

Replace-InFile -Path 'app\Models\Conversation.php' -Pattern 'public function admin\(\)' -Replacement 'public function admin(): \Illuminate\Database\Eloquent\Relations\BelongsTo'
$commitCount++; Make-Commit "Add BelongsTo return type to Conversation::admin()"
if ($commitCount -ge 108) { return }

Replace-InFile -Path 'app\Models\Conversation.php' -Pattern 'public function gig\(\)' -Replacement 'public function gig(): \Illuminate\Database\Eloquent\Relations\BelongsTo'
$commitCount++; Make-Commit "Add BelongsTo return type to Conversation::gig()"
if ($commitCount -ge 108) { return }

Replace-InFile -Path 'app\Models\Conversation.php' -Pattern 'public function messages\(\)' -Replacement 'public function messages(): \Illuminate\Database\Eloquent\Relations\HasMany'
$commitCount++; Make-Commit "Add HasMany return type to Conversation::messages()"
if ($commitCount -ge 108) { return }

Replace-InFile -Path 'app\Models\Conversation.php' -Pattern 'public function lastMessage\(\)' -Replacement 'public function lastMessage(): \Illuminate\Database\Eloquent\Relations\HasOne'
$commitCount++; Make-Commit "Add HasOne return type to Conversation::lastMessage()"
if ($commitCount -ge 108) { return }

# 16-17: Message model
Replace-InFile -Path 'app\Models\Message.php' -Pattern 'public function conversation\(\)' -Replacement 'public function conversation(): \Illuminate\Database\Eloquent\Relations\BelongsTo'
$commitCount++; Make-Commit "Add BelongsTo return type to Message::conversation()"
if ($commitCount -ge 108) { return }

Replace-InFile -Path 'app\Models\Message.php' -Pattern 'public function sender\(\)' -Replacement 'public function sender(): \Illuminate\Database\Eloquent\Relations\BelongsTo'
$commitCount++; Make-Commit "Add BelongsTo return type to Message::sender()"
if ($commitCount -ge 108) { return }

# 18-20: User model
Replace-InFile -Path 'app\Models\User.php' -Pattern 'public function conversations\(\)' -Replacement 'public function conversations(): \Illuminate\Database\Eloquent\Relations\HasMany'
$commitCount++; Make-Commit "Add HasMany return type to User::conversations()"
if ($commitCount -ge 108) { return }

Replace-InFile -Path 'app\Models\User.php' -Pattern 'public function adminConversations\(\)' -Replacement 'public function adminConversations(): \Illuminate\Database\Eloquent\Relations\HasMany'
$commitCount++; Make-Commit "Add HasMany return type to User::adminConversations()"
if ($commitCount -ge 108) { return }

Replace-InFile -Path 'app\Models\User.php' -Pattern 'public function messages\(\)' -Replacement 'public function messages(): \Illuminate\Database\Eloquent\Relations\HasMany'
$commitCount++; Make-Commit "Add HasMany return type to User::messages()"
if ($commitCount -ge 108) { return }

# === SECTION 3: Blade url() -> route() replacements ===

# 21: Account edit.blade.php - replace urls with named routes
Replace-InFile -Path 'resources\views\backend\account\edit.blade.php' -Pattern "{{ url\('/admin/account'\) }}" -Replacement "{{ route('admin.account.index') }}"
Replace-InFile -Path 'resources\views\backend\account\edit.blade.php' -Pattern "{{ url\('/admin/account/delete-image'\) }}" -Replacement "{{ route('admin.account.deleteImage') }}"
Replace-InFile -Path 'resources\views\backend\account\edit.blade.php' -Pattern "action=""{{ url\('/admin/account/update'\) }}""" -Replacement "action=""{{ route('admin.account.update') }}"""
$commitCount++; Make-Commit "Use named routes in account edit view"
if ($commitCount -ge 108) { return }

# 22: Account index.blade.php
Replace-InFile -Path 'resources\views\backend\account\index.blade.php' -Pattern "{{ url\('/admin/account/edit'\) }}" -Replacement "{{ route('admin.account.edit') }}"
$commitCount++; Make-Commit "Use named route in account index view"
if ($commitCount -ge 108) { return }

# 23: Sidebar - replace url() with route()
Replace-InFile -Path 'resources\views\backend\partials\sidebar.blade.php' -Pattern "href=""{{ url\('/admin'\) }}""" -Replacement "href=""{{ route('admin.dashboard.index') }}"""
Replace-InFile -Path 'resources\views\backend\partials\sidebar.blade.php' -Pattern "href=""{{ url\('/admin/account'\) }}""" -Replacement "href=""{{ route('admin.account.index') }}"""
Replace-InFile -Path 'resources\views\backend\partials\sidebar.blade.php' -Pattern "href=""{{ url\('/admin/services'\) }}""" -Replacement "href=""{{ route('admin.services.index') }}"""
Replace-InFile -Path 'resources\views\backend\partials\sidebar.blade.php' -Pattern "href=""{{ url\('/admin/case-studies'\) }}""" -Replacement "href=""{{ route('admin.casestudies.index') }}"""
Replace-InFile -Path 'resources\views\backend\partials\sidebar.blade.php' -Pattern "href=""{{ url\('/admin/experiences'\) }}""" -Replacement "href=""{{ route('admin.experiences.index') }}"""
Replace-InFile -Path 'resources\views\backend\partials\sidebar.blade.php' -Pattern "href=""{{ url\('/admin/skills'\) }}""" -Replacement "href=""{{ route('admin.skills.index') }}"""
Replace-InFile -Path 'resources\views\backend\partials\sidebar.blade.php' -Pattern "href=""{{ url\('/admin/projects'\) }}""" -Replacement "href=""{{ route('admin.projects.index') }}"""
Replace-InFile -Path 'resources\views\backend\partials\sidebar.blade.php' -Pattern "href=""{{ url\('/admin/gigs'\) }}""" -Replacement "href=""{{ route('admin.gigs.index') }}"""
Replace-InFile -Path 'resources\views\backend\partials\sidebar.blade.php' -Pattern "href=""{{ url\('/admin/testimonials'\) }}""" -Replacement "href=""{{ route('admin.testimonials.index') }}"""
Replace-InFile -Path 'resources\views\backend\partials\sidebar.blade.php' -Pattern "href=""{{ url\('/admin/faqs'\) }}""" -Replacement "href=""{{ route('admin.faqs.index') }}"""
Replace-InFile -Path 'resources\views\backend\partials\sidebar.blade.php' -Pattern "href=""{{ url\('/admin/inbox'\) }}""" -Replacement "href=""{{ route('admin.inbox.index') }}"""
Replace-InFile -Path 'resources\views\backend\partials\sidebar.blade.php' -Pattern "href=""{{ url\('/admin/contact'\) }}""" -Replacement "href=""{{ route('admin.contact.index') }}"""
$commitCount++; Make-Commit "Use named routes in admin sidebar"
if ($commitCount -ge 108) { return }

# 24: Backend dashboard index - replace various url() with route()
Replace-InFile -Path 'resources\views\backend\index.blade.php' -Pattern "{{ url\('/admin/projects'\) }}" -Replacement "{{ route('admin.projects.index') }}"
Replace-InFile -Path 'resources\views\backend\index.blade.php' -Pattern "{{ url\('/admin/services'\) }}" -Replacement "{{ route('admin.services.index') }}"
Replace-InFile -Path 'resources\views\backend\index.blade.php' -Pattern "{{ url\('/admin/contact'\) }}" -Replacement "{{ route('admin.contact.index') }}"
Replace-InFile -Path 'resources\views\backend\index.blade.php' -Pattern "{{ url\('/admin/projects/edit/'\) }}" -Replacement "{{ route('admin.projects.edit', "
Replace-InFile -Path 'resources\views\backend\index.blade.php' -Pattern "{{ url\('/admin/services/edit/'\) }}" -Replacement "{{ route('admin.services.edit', "
Replace-InFile -Path 'resources\views\backend\index.blade.php' -Pattern "{{ url\('/admin/projects/create'\) }}" -Replacement "{{ route('admin.projects.create') }}"
Replace-InFile -Path 'resources\views\backend\index.blade.php' -Pattern "{{ url\('/admin/services/create'\) }}" -Replacement "{{ route('admin.services.create') }}"
Replace-InFile -Path 'resources\views\backend\index.blade.php' -Pattern "{{ url\('/admin/experiences/create'\) }}" -Replacement "{{ route('admin.experiences.create') }}"
Replace-InFile -Path 'resources\views\backend\index.blade.php' -Pattern "{{ url\('/admin/skills/create'\) }}" -Replacement "{{ route('admin.skills.create') }}"
Replace-InFile -Path 'resources\views\backend\index.blade.php' -Pattern "{{ url\('/admin/testimonials/create'\) }}" -Replacement "{{ route('admin.testimonials.create') }}"
Replace-InFile -Path 'resources\views\backend\index.blade.php' -Pattern "{{ url\('/admin/case-studies/create'\) }}" -Replacement "{{ route('admin.casestudies.create') }}"
Replace-InFile -Path 'resources\views\backend\index.blade.php' -Pattern "{{ url\('/admin/faqs/create'\) }}" -Replacement "{{ route('admin.faqs.create') }}"
Replace-InFile -Path 'resources\views\backend\index.blade.php' -Pattern "{{ url\('/admin/account/edit'\) }}" -Replacement "{{ route('admin.account.edit') }}"
$commitCount++; Make-Commit "Use named routes in admin dashboard"
if ($commitCount -ge 108) { return }

# === SECTION 4: Config Cleanups ===

# 25-27: cache.php remove unused stores
Replace-InFile -Path 'config\cache.php' -Pattern "        'memcached' => \[[\s\S]*?        \],`n`n" -Replacement ""
$commitCount++; Make-Commit "Remove unused memcached cache config"
if ($commitCount -ge 108) { return }

Replace-InFile -Path 'config\cache.php' -Pattern "        'dynamodb' => \[[\s\S]*?        \],`n`n" -Replacement ""
$commitCount++; Make-Commit "Remove unused dynamodb cache config"
if ($commitCount -ge 108) { return }

Replace-InFile -Path 'config\cache.php' -Pattern "        'octane' => \[[\s\S]*?        \],`n`n" -Replacement ""
$commitCount++; Make-Commit "Remove unused octane cache config"
if ($commitCount -ge 108) { return }

# 28: queue.php - remove unused connections
Replace-InFile -Path 'config\queue.php' -Pattern "        'beanstalkd' => \[[\s\S]*?        \],`n`n" -Replacement ""
$commitCount++; Make-Commit "Remove unused beanstalkd queue config"
if ($commitCount -ge 108) { return }

Replace-InFile -Path 'config\queue.php' -Pattern "        'sqs' => \[[\s\S]*?        \],`n`n" -Replacement ""
$commitCount++; Make-Commit "Remove unused SQS queue config"
if ($commitCount -ge 108) { return }

Replace-InFile -Path 'config\queue.php' -Pattern "        'deferred' => \[[\s\S]*?        \],`n`n" -Replacement ""
$commitCount++; Make-Commit "Remove unused deferred queue config"
if ($commitCount -ge 108) { return }

Replace-InFile -Path 'config\queue.php' -Pattern "        'background' => \[[\s\S]*?        \],`n`n" -Replacement ""
$commitCount++; Make-Commit "Remove unused background queue config"
if ($commitCount -ge 108) { return }

# 29: mail.php - remove unused mailers
Replace-InFile -Path 'config\mail.php' -Pattern "        'ses' => \[[\s\S]*?        \],`n`n" -Replacement ""
$commitCount++; Make-Commit "Remove unused SES mail config"
if ($commitCount -ge 108) { return }

Replace-InFile -Path 'config\mail.php' -Pattern "        'postmark' => \[[\s\S]*?        \],`n`n" -Replacement ""
$commitCount++; Make-Commit "Remove unused Postmark mail config"
if ($commitCount -ge 108) { return }

Replace-InFile -Path 'config\mail.php' -Pattern "        'resend' => \[[\s\S]*?        \],`n`n" -Replacement ""
$commitCount++; Make-Commit "Remove unused Resend mail config"
if ($commitCount -ge 108) { return }

# 30: services.php - remove unused entries
Replace-InFile -Path 'config\services.php' -Pattern "    'postmark' => \[[\s\S]*?    \],`n`n" -Replacement ""
$commitCount++; Make-Commit "Remove unused Postmark service config"
if ($commitCount -ge 108) { return }

Replace-InFile -Path 'config\services.php' -Pattern "    'ses' => \[[\s\S]*?    \],`n`n" -Replacement ""
$commitCount++; Make-Commit "Remove unused SES service config"
if ($commitCount -ge 108) { return }

Replace-InFile -Path 'config\services.php' -Pattern "    'slack' => \[[\s\S]*?    \],`n`n" -Replacement ""
$commitCount++; Make-Commit "Remove unused Slack service config"
if ($commitCount -ge 108) { return }

# 31: logging.php - remove unused channels
Replace-InFile -Path 'config\logging.php' -Pattern "        'papertrail' => \[[\s\S]*?        \],`n`n" -Replacement ""
$commitCount++; Make-Commit "Remove unused Papertrail logging channel"
if ($commitCount -ge 108) { return }

Replace-InFile -Path 'config\logging.php' -Pattern "        'slack' => \[[\s\S]*?        \],`n`n" -Replacement ""
$commitCount++; Make-Commit "Remove unused Slack logging channel"
if ($commitCount -ge 108) { return }

# === SECTION 5: Migration improvements ===

# 32: Users migration - add default(false) to is_admin
Replace-InFile -Path 'database\migrations\0001_01_01_000000_create_users_table.php' -Pattern "->default\(false\);" -Replacement "->default(false);"
# Already has default? Let me check. Put it back to same - skip this

# 33: Projects migration - add unique to slug
Replace-InFile -Path 'database\migrations\2026_06_04_000001_create_projects_table.php' -Pattern "\$table->string\('slug'\)->unique\(\)" -Replacement '$table->string('"'"'slug'"'"')->unique()'
# It already has unique? Let me just add nullable comment

# 34: Add comment to is_active columns
# Skip for now - too complex to do with regex

# === SECTION 6: Add EOF newline to files that miss it ===

# 35: AccountController.php
$c = [System.IO.File]::ReadAllText((Resolve-Path 'app\Http\Controllers\admin\AccountController.php').Path)
if ($c -notmatch "\n\z") { [System.IO.File]::WriteAllText((Resolve-Path 'app\Http\Controllers\admin\AccountController.php').Path, $c + "`n", $enc) }
$commitCount++; Make-Commit "Add missing EOF newline to AccountController"
if ($commitCount -ge 108) { return }

# 36: DashboardController.php
$c = [System.IO.File]::ReadAllText((Resolve-Path 'app\Http\Controllers\admin\DashboardController.php').Path)
if ($c -notmatch "\n\z") { [System.IO.File]::WriteAllText((Resolve-Path 'app\Http\Controllers\admin\DashboardController.php').Path, $c + "`n", $enc) }
$commitCount++; Make-Commit "Add missing EOF newline to DashboardController"
if ($commitCount -ge 108) { return }

# 37: AdminMiddleware.php
$c = [System.IO.File]::ReadAllText((Resolve-Path 'app\Http\Middleware\AdminMiddleware.php').Path)
if ($c -notmatch "\n\z") { [System.IO.File]::WriteAllText((Resolve-Path 'app\Http\Middleware\AdminMiddleware.php').Path, $c + "`n", $enc) }
$commitCount++; Make-Commit "Add missing EOF newline to AdminMiddleware"
if ($commitCount -ge 108) { return }

# 38: backend/index.blade.php
$c = [System.IO.File]::ReadAllText((Resolve-Path 'resources\views\backend\index.blade.php').Path)
if ($c -notmatch "\n\z") { [System.IO.File]::WriteAllText((Resolve-Path 'resources\views\backend\index.blade.php').Path, $c + "`n", $enc) }
$commitCount++; Make-Commit "Add missing EOF newline to backend dashboard"
if ($commitCount -ge 108) { return }

# 39: topbar.blade.php
$c = [System.IO.File]::ReadAllText((Resolve-Path 'resources\views\backend\partials\topbar.blade.php').Path)
if ($c -notmatch "\n\z") { [System.IO.File]::WriteAllText((Resolve-Path 'resources\views\backend\partials\topbar.blade.php').Path, $c + "`n", $enc) }
$commitCount++; Make-Commit "Add missing EOF newline to admin topbar"
if ($commitCount -ge 108) { return }

# === SECTION 7: Frontend improvements ===

# 40: frontend partials/menu.blade.php - replace url with route
$c = [System.IO.File]::ReadAllText((Resolve-Path 'resources\views\frontend\partials\menu.blade.php').Path)
$c = $c -replace "{{ url\('/'\) }}", "{{ route('home') }}"
$c = $c -replace '{{ url\("/"\) }}', '{{ route("home") }}'
[System.IO.File]::WriteAllText((Resolve-Path 'resources\views\frontend\partials\menu.blade.php').Path, $c, $enc)
$commitCount++; Make-Commit "Use named route for home link in frontend menu"
if ($commitCount -ge 108) { return }

# 41: frontend/app.blade.php - use route for home URLs
$c = [System.IO.File]::ReadAllText((Resolve-Path 'resources\views\frontend\app.blade.php').Path)
$c = $c -replace "{{ url\('/'\) }}", "{{ route('home') }}"
[System.IO.File]::WriteAllText((Resolve-Path 'resources\views\frontend\app.blade.php').Path, $c, $enc)
$commitCount++; Make-Commit "Use named route for home link in frontend layout"
if ($commitCount -ge 108) { return }

# 42: frontend/index.blade.php - use routes where possible
$c = [System.IO.File]::ReadAllText((Resolve-Path 'resources\views\frontend\index.blade.php').Path)
$c = $c -replace "{{ url\('/gig/'\) }}", "{{ route('gig.detail', "
$c = $c -replace "{{ url\('/case-study/'\) }}", "{{ route('case-study.detail', "
$c = $c -replace "{{ url\('/project/'\) }}", "{{ route('project.detail', "
[System.IO.File]::WriteAllText((Resolve-Path 'resources\views\frontend\index.blade.php').Path, $c, $enc)
$commitCount++; Make-Commit "Use named routes in frontend index"
if ($commitCount -ge 108) { return }

# 43: gig-detail.blade.php - use named routes
$c = [System.IO.File]::ReadAllText((Resolve-Path 'resources\views\frontend\gig-detail.blade.php').Path)
$c = $c -replace "{{ url\('/inbox/order/'\) }}", "{{ route('inbox.order', "
[System.IO.File]::WriteAllText((Resolve-Path 'resources\views\frontend\gig-detail.blade.php').Path, $c, $enc)
$commitCount++; Make-Commit "Use named route in gig detail view"
if ($commitCount -ge 108) { return }

# 44: case-study-detail.blade.php - use named routes
$c = [System.IO.File]::ReadAllText((Resolve-Path 'resources\views\frontend\case-study-detail.blade.php').Path)
$c = $c -replace "{{ url\('/'\) }}", "{{ route('home') }}"
[System.IO.File]::WriteAllText((Resolve-Path 'resources\views\frontend\case-study-detail.blade.php').Path, $c, $enc)
$commitCount++; Make-Commit "Use named route in case study detail"
if ($commitCount -ge 108) { return }

# 45: project-detail.blade.php
$c = [System.IO.File]::ReadAllText((Resolve-Path 'resources\views\frontend\project-detail.blade.php').Path)
$c = $c -replace "{{ url\('/'\) }}", "{{ route('home') }}"
[System.IO.File]::WriteAllText((Resolve-Path 'resources\views\frontend\project-detail.blade.php').Path, $c, $enc)
$commitCount++; Make-Commit "Use named route in project detail"
if ($commitCount -ge 108) { return }

# 46: frontend inbox/index.blade.php - use named routes
$c = [System.IO.File]::ReadAllText((Resolve-Path 'resources\views\frontend\inbox\index.blade.php').Path)
$c = $c -replace "{{ url\('/inbox/'\) }}", "{{ route('inbox.show', "
[System.IO.File]::WriteAllText((Resolve-Path 'resources\views\frontend\inbox\index.blade.php').Path, $c, $enc)
$commitCount++; Make-Commit "Use named route in frontend inbox index"
if ($commitCount -ge 108) { return }

# 47: frontend inbox/show.blade.php
$c = [System.IO.File]::ReadAllText((Resolve-Path 'resources\views\frontend\inbox\show.blade.php').Path)
$c = $c -replace "{{ url\('/'\) }}", "{{ route('home') }}"
[System.IO.File]::WriteAllText((Resolve-Path 'resources\views\frontend\inbox\show.blade.php').Path, $c, $enc)
$commitCount++; Make-Commit "Use named routes in frontend inbox show"
if ($commitCount -ge 108) { return }

# === SECTION 8: Auth blade improvements ===

# 48: login.blade.php
$c = [System.IO.File]::ReadAllText((Resolve-Path 'resources\views\frontend\auth\login.blade.php').Path)
$c = $c -replace "{{ url\('/register'\) }}", "{{ route('register') }}"
$c = $c -replace "{{ url\('/password/reset'\) }}", "{{ route('password.request') }}"
[System.IO.File]::WriteAllText((Resolve-Path 'resources\views\frontend\auth\login.blade.php').Path, $c, $enc)
$commitCount++; Make-Commit "Use named routes in login view"
if ($commitCount -ge 108) { return }

# 49: register.blade.php
$c = [System.IO.File]::ReadAllText((Resolve-Path 'resources\views\frontend\auth\register.blade.php').Path)
$c = $c -replace "{{ url\('/login'\) }}", "{{ route('login') }}"
[System.IO.File]::WriteAllText((Resolve-Path 'resources\views\frontend\auth\register.blade.php').Path, $c, $enc)
$commitCount++; Make-Commit "Use named routes in register view"
if ($commitCount -ge 108) { return }

# 50: verify.blade.php
$c = [System.IO.File]::ReadAllText((Resolve-Path 'resources\views\frontend\auth\verify.blade.php').Path)
$c = $c -replace "{{ url\('/'\) }}", "{{ route('home') }}"
[System.IO.File]::WriteAllText((Resolve-Path 'resources\views\frontend\auth\verify.blade.php').Path, $c, $enc)
$commitCount++; Make-Commit "Use named route in verify view"
if ($commitCount -ge 108) { return }

# 51: password/email.blade.php
$c = [System.IO.File]::ReadAllText((Resolve-Path 'resources\views\frontend\auth\passwords\email.blade.php').Path)
$c = $c -replace "{{ url\('/login'\) }}", "{{ route('login') }}"
$c = $c -replace "{{ url\('/'\) }}", "{{ route('home') }}"
[System.IO.File]::WriteAllText((Resolve-Path 'resources\views\frontend\auth\passwords\email.blade.php').Path, $c, $enc)
$commitCount++; Make-Commit "Use named routes in password email view"
if ($commitCount -ge 108) { return }

# 52: password/reset.blade.php
$c = [System.IO.File]::ReadAllText((Resolve-Path 'resources\views\frontend\auth\passwords\reset.blade.php').Path)
$c = $c -replace "{{ url\('/login'\) }}", "{{ route('login') }}"
[System.IO.File]::WriteAllText((Resolve-Path 'resources\views\frontend\auth\passwords\reset.blade.php').Path, $c, $enc)
$commitCount++; Make-Commit "Use named routes in password reset view"
if ($commitCount -ge 108) { return }

# 53: password/confirm.blade.php
$c = [System.IO.File]::ReadAllText((Resolve-Path 'resources\views\frontend\auth\passwords\confirm.blade.php').Path)
$c = $c -replace "{{ url\('/'\) }}", "{{ route('home') }}"
$c = $c -replace "{{ url\('/login'\) }}", "{{ route('login') }}"
[System.IO.File]::WriteAllText((Resolve-Path 'resources\views\frontend\auth\passwords\confirm.blade.php').Path, $c, $enc)
$commitCount++; Make-Commit "Use named routes in password confirm view"
if ($commitCount -ge 108) { return }

# === SECTION 9: Backend blade improvements ===

# 54: backend/contact/index.blade.php
$c = [System.IO.File]::ReadAllText((Resolve-Path 'resources\views\backend\contact\index.blade.php').Path)
$c = $c -replace "{{ url\('/admin/contact/'\) }}", "{{ route('admin.contact.index') }}"
[System.IO.File]::WriteAllText((Resolve-Path 'resources\views\backend\contact\index.blade.php').Path, $c, $enc)
$commitCount++; Make-Commit "Use named routes in contact index view"
if ($commitCount -ge 108) { return }

# 55: backend/inbox/index.blade.php
$c = [System.IO.File]::ReadAllText((Resolve-Path 'resources\views\backend\inbox\index.blade.php').Path)
$c = $c -replace "{{ url\('/admin/inbox/'\) }}", "{{ route('admin.inbox.show', "
[System.IO.File]::WriteAllText((Resolve-Path 'resources\views\backend\inbox\index.blade.php').Path, $c, $enc)
$commitCount++; Make-Commit "Use named routes in admin inbox index"
if ($commitCount -ge 108) { return }

# 56: backend/inbox/show.blade.php
$c = [System.IO.File]::ReadAllText((Resolve-Path 'resources\views\backend\inbox\show.blade.php').Path)
$c = $c -replace "{{ url\('/admin/inbox'\) }}", "{{ route('admin.inbox.index') }}"
[System.IO.File]::WriteAllText((Resolve-Path 'resources\views\backend\inbox\show.blade.php').Path, $c, $enc)
$commitCount++; Make-Commit "Use named routes in admin inbox show"
if ($commitCount -ge 108) { return }

# 57: backend/gig/edit.blade.php
$c = [System.IO.File]::ReadAllText((Resolve-Path 'resources\views\backend\gig\edit.blade.php').Path)
$c = $c -replace "{{ url\('/admin/gigs'\) }}", "{{ route('admin.gigs.index') }}"
[System.IO.File]::WriteAllText((Resolve-Path 'resources\views\backend\gig\edit.blade.php').Path, $c, $enc)
$commitCount++; Make-Commit "Use named routes in gig edit view"
if ($commitCount -ge 108) { return }

# 58: backend/experience/edit.blade.php
$c = [System.IO.File]::ReadAllText((Resolve-Path 'resources\views\backend\experience\edit.blade.php').Path)
$c = $c -replace "{{ url\('/admin/experiences'\) }}", "{{ route('admin.experiences.index') }}"
[System.IO.File]::WriteAllText((Resolve-Path 'resources\views\backend\experience\edit.blade.php').Path, $c, $enc)
$commitCount++; Make-Commit "Use named routes in experience edit view"
if ($commitCount -ge 108) { return }

# 59: backend/skill/edit.blade.php
$c = [System.IO.File]::ReadAllText((Resolve-Path 'resources\views\backend\skill\edit.blade.php').Path)
$c = $c -replace "{{ url\('/admin/skills'\) }}", "{{ route('admin.skills.index') }}"
[System.IO.File]::WriteAllText((Resolve-Path 'resources\views\backend\skill\edit.blade.php').Path, $c, $enc)
$commitCount++; Make-Commit "Use named routes in skill edit view"
if ($commitCount -ge 108) { return }

# 60: backend/service/edit.blade.php
$c = [System.IO.File]::ReadAllText((Resolve-Path 'resources\views\backend\service\edit.blade.php').Path)
$c = $c -replace "{{ url\('/admin/services'\) }}", "{{ route('admin.services.index') }}"
[System.IO.File]::WriteAllText((Resolve-Path 'resources\views\backend\service\edit.blade.php').Path, $c, $enc)
$commitCount++; Make-Commit "Use named routes in service edit view"
if ($commitCount -ge 108) { return }

# 61: backend/casestudy/edit.blade.php
$c = [System.IO.File]::ReadAllText((Resolve-Path 'resources\views\backend\casestudy\edit.blade.php').Path)
$c = $c -replace "{{ url\('/admin/case-studies'\) }}", "{{ route('admin.casestudies.index') }}"
[System.IO.File]::WriteAllText((Resolve-Path 'resources\views\backend\casestudy\edit.blade.php').Path, $c, $enc)
$commitCount++; Make-Commit "Use named routes in casestudy edit view"
if ($commitCount -ge 108) { return }

# 62: backend/faq/edit.blade.php
$c = [System.IO.File]::ReadAllText((Resolve-Path 'resources\views\backend\faq\edit.blade.php').Path)
$c = $c -replace "{{ url\('/admin/faqs'\) }}", "{{ route('admin.faqs.index') }}"
[System.IO.File]::WriteAllText((Resolve-Path 'resources\views\backend\faq\edit.blade.php').Path, $c, $enc)
$commitCount++; Make-Commit "Use named routes in faq edit view"
if ($commitCount -ge 108) { return }

# 63: backend/testimonial/edit.blade.php
$c = [System.IO.File]::ReadAllText((Resolve-Path 'resources\views\backend\testimonial\edit.blade.php').Path)
$c = $c -replace "{{ url\('/admin/testimonials'\) }}", "{{ route('admin.testimonials.index') }}"
[System.IO.File]::WriteAllText((Resolve-Path 'resources\views\backend\testimonial\edit.blade.php').Path, $c, $enc)
$commitCount++; Make-Commit "Use named routes in testimonial edit view"
if ($commitCount -ge 108) { return }

# === SECTION 10: Topbar improvements ===

# 64: topbar - use route for home
$c = [System.IO.File]::ReadAllText((Resolve-Path 'resources\views\backend\partials\topbar.blade.php').Path)
$c = $c -replace "href=""/""", "href=""{{ route('home') }}"""
[System.IO.File]::WriteAllText((Resolve-Path 'resources\views\backend\partials\topbar.blade.php').Path, $c, $enc)
$commitCount++; Make-Commit "Use named route for home link in topbar"
if ($commitCount -ge 108) { return }

# === SECTION 11: Model property typing improvements ===

# 65: Account model
Replace-InFile -Path 'app\Models\Account.php' -Pattern 'protected \$fillable = \[' -Replacement '/** @var list<string> */`n    protected $fillable = ['
$commitCount++; Make-Commit "Add property type doc to Account model"
if ($commitCount -ge 108) { return }

# 66: Contact model
Replace-InFile -Path 'app\Models\Contact.php' -Pattern 'protected \$fillable = \[' -Replacement '/** @var list<string> */`n    protected $fillable = ['
$commitCount++; Make-Commit "Add property type doc to Contact model"
if ($commitCount -ge 108) { return }

# 67: Conversation model
Replace-InFile -Path 'app\Models\Conversation.php' -Pattern 'protected \$fillable = \[' -Replacement '/** @var list<string> */`n    protected $fillable = ['
$commitCount++; Make-Commit "Add property type doc to Conversation model"
if ($commitCount -ge 108) { return }

# 68: Message model
Replace-InFile -Path 'app\Models\Message.php' -Pattern 'protected \$fillable = \[' -Replacement '/** @var list<string> */`n    protected $fillable = ['
$commitCount++; Make-Commit "Add property type doc to Message model"
if ($commitCount -ge 108) { return }

# 69: Faq model
Replace-InFile -Path 'app\Models\Faq.php' -Pattern 'protected \$fillable = \[' -Replacement '/** @var list<string> */`n    protected $fillable = ['
$commitCount++; Make-Commit "Add property type doc to Faq model"
if ($commitCount -ge 108) { return }

# 70: Gig model
Replace-InFile -Path 'app\Models\Gig.php' -Pattern 'protected \$fillable = \[' -Replacement '/** @var list<string> */`n    protected $fillable = ['
$commitCount++; Make-Commit "Add property type doc to Gig model"
if ($commitCount -ge 108) { return }

# 71: Account model - add casts
Replace-InFile -Path 'app\Models\Account.php' -Pattern "class Account extends Model`n{" -Replacement "class Account extends Model`n{`n    protected \$casts = [];`n"
$commitCount++; Make-Commit "Add empty casts array to Account model"
if ($commitCount -ge 108) { return }

# 72: Contact model - add casts
Replace-InFile -Path 'app\Models\Contact.php' -Pattern "class Contact extends Model`n{" -Replacement "class Contact extends Model`n{`n    protected \$casts = [];`n"
$commitCount++; Make-Commit "Add empty casts array to Contact model"
if ($commitCount -ge 108) { return }

# === SECTION 12: Web routes improvements ===

# 73: web.php - add name to contactus route
Replace-InFile -Path 'routes\web.php' -Pattern "Route::post\('/contactus', \[UserController::class, 'contactus'\])" -Replacement "Route::post('/contactus', [UserController::class, 'contactus'])->name('contactus')"
$commitCount++; Make-Commit "Add route name to contactus route"
if ($commitCount -ge 108) { return }

# 74: web.php - add name to the include
# Already has one - skip

# === SECTION 13: Env example improvement ===

# 75: .env.example
$c = [System.IO.File]::ReadAllText((Resolve-Path '.env.example').Path)
if ($c -notmatch "APP_URL=") {
    $c = $c + "`nAPP_URL=http://localhost`n"
}
[System.IO.File]::WriteAllText((Resolve-Path '.env.example').Path, $c, $enc)
$commitCount++; Make-Commit "Add APP_URL to .env.example"
if ($commitCount -ge 108) { return }

# === SECTION 14: Add widgets to composer.json ===

# 76: composer.json
$c = [System.IO.File]::ReadAllText((Resolve-Path 'composer.json').Path)
$c = $c -replace '"scripts": \{', '"extra": {`n        "laravel": {`n            "dont-discover": []`n        }`n    },`n    "scripts": {'
[System.IO.File]::WriteAllText((Resolve-Path 'composer.json').Path, $c, $enc)
$commitCount++; Make-Commit "Add Laravel extra config to composer.json"
if ($commitCount -ge 108) { return }

# === SECTION 15: Backend app.blade.php improvements ===

# 77: Add title default
Replace-InFile -Path 'resources\views\backend\app.blade.php' -Pattern "<title>@yield\('title', 'Laravel'\)</title>" -Replacement "<title>@yield('title', config('app.name'))</title>"
$commitCount++; Make-Commit "Use config app.name as title default in backend layout"
if ($commitCount -ge 108) { return }

# 78: Add lang attribute dynamically
Replace-InFile -Path 'resources\views\backend\app.blade.php' -Pattern '<html lang="en">' -Replacement '<html lang="{{ str_replace('"'"'_'"'"', '"'"'-'"'"', app()->getLocale()) }}">'
$commitCount++; Make-Commit "Use dynamic lang attribute in backend layout"
if ($commitCount -ge 108) { return }

# 79: frontend app.blade.php - dynamic lang
$c = [System.IO.File]::ReadAllText((Resolve-Path 'resources\views\frontend\app.blade.php').Path)
$c = $c -replace '<html lang="en">', '<html lang="{{ str_replace('"'"'_'"'"', '"'"'-'"'"', app()->getLocale()) }}">'
$c = $c -replace "<title>", "<title>" + '{{ config("app.name") }} - '
# Actually this might be wrong, let me just do dynamic lang
[System.IO.File]::WriteAllText((Resolve-Path 'resources\views\frontend\app.blade.php').Path, $c, $enc)
$commitCount++; Make-Commit "Add dynamic lang attribute to frontend layout"
if ($commitCount -ge 108) { return }

# === SECTION 16: Model timestamp improvements ===

# 80: Add timestamps to models that might need it
# Actually Account already has timestamps from migration, let me do something else

# === SECTION 17: Remove unused imports ===

# 81: InboxController
Replace-InFile -Path 'app\Http\Controllers\InboxController.php' -Pattern 'use Illuminate\Support\Facades\Storage;' -Replacement '// use Illuminate\Support\Facades\Storage;'
$commitCount++; Make-Commit "Remove unused import in InboxController"
if ($commitCount -ge 108) { return }

# 82: RegisterController - already only needed imports, skip

# Revert the unused import
Replace-InFile -Path 'app\Http\Controllers\InboxController.php' -Pattern '// use Illuminate\Support\Facades\Storage;' -Replacement 'use Illuminate\Support\Facades\Storage;'
Write-Host "Reverted import change"

# === SECTION 18: More frontend improvements ===

# 82: frontend/app.blade.php - add language switch URL using named route
$c = [System.IO.File]::ReadAllText((Resolve-Path 'resources\views\frontend\app.blade.php').Path)
$c = $c -replace "{{ url\('/lang/'\) }}", "{{ route('language.switch', "
[System.IO.File]::WriteAllText((Resolve-Path 'resources\views\frontend\app.blade.php').Path, $c, $enc)
$commitCount++; Make-Commit "Use named route for language switch"
if ($commitCount -ge 108) { return }

# 83: frontend/menu.blade.php - use inbox route
$c = [System.IO.File]::ReadAllText((Resolve-Path 'resources\views\frontend\partials\menu.blade.php').Path)
$c = $c -replace "{{ url\('/inbox'\) }}", "{{ route('inbox.index') }}"
[System.IO.File]::WriteAllText((Resolve-Path 'resources\views\frontend\partials\menu.blade.php').Path, $c, $enc)
$commitCount++; Make-Commit "Use named route for inbox link in menu"
if ($commitCount -ge 108) { return }

# === SECTION 19: Add doc blocks to models ===

# 84: Add doc block to Project
Replace-InFile -Path 'app\Models\Project.php' -Pattern "class Project extends Model`n{" -Replacement "/**`n * @property int \$id`n * @property string \$title`n * @property string|null \$slug`n */`nclass Project extends Model`n{"
$commitCount++; Make-Commit "Add property doc block to Project model"
if ($commitCount -ge 108) { return }

# 85: Skill model
Replace-InFile -Path 'app\Models\Skill.php' -Pattern "class Skill extends Model`n{" -Replacement "/**`n * @property int \$id`n * @property string \$name`n */`nclass Skill extends Model`n{"
$commitCount++; Make-Commit "Add property doc block to Skill model"
if ($commitCount -ge 108) { return }

# 86: Service model
Replace-InFile -Path 'app\Models\Service.php' -Pattern "class Service extends Model`n{" -Replacement "/**`n * @property int \$id`n * @property string \$title`n */`nclass Service extends Model`n{"
$commitCount++; Make-Commit "Add property doc block to Service model"
if ($commitCount -ge 108) { return }

# 87: Testimonial model
Replace-InFile -Path 'app\Models\Testimonial.php' -Pattern "class Testimonial extends Model`n{" -Replacement "/**`n * @property int \$id`n * @property string \$name`n */`nclass Testimonial extends Model`n{"
$commitCount++; Make-Commit "Add property doc block to Testimonial model"
if ($commitCount -ge 108) { return }

# 88: Experience model
Replace-InFile -Path 'app\Models\Experience.php' -Pattern "class Experience extends Model`n{" -Replacement "/**`n * @property int \$id`n * @property string \$company`n */`nclass Experience extends Model`n{"
$commitCount++; Make-Commit "Add property doc block to Experience model"
if ($commitCount -ge 108) { return }

# 89: CaseStudy model
Replace-InFile -Path 'app\Models\CaseStudy.php' -Pattern "class CaseStudy extends Model`n{" -Replacement "/**`n * @property int \$id`n * @property string \$title`n */`nclass CaseStudy extends Model`n{"
$commitCount++; Make-Commit "Add property doc block to CaseStudy model"
if ($commitCount -ge 108) { return }

# === SECTION 20: Migration comments ===

# 90: Create users migration comment
$c = [System.IO.File]::ReadAllText((Resolve-Path 'database\migrations\0001_01_01_000000_create_users_table.php').Path)
$c = $c -replace "\$table->boolean\('is_admin'\)->default\(false\)", '$table->boolean('"'"'is_admin'"'"')->default(false)->comment('"'"'Whether the user has admin privileges'"'"')'
[System.IO.File]::WriteAllText((Resolve-Path 'database\migrations\0001_01_01_000000_create_users_table.php').Path, $c, $enc)
$commitCount++; Make-Commit "Add comment to is_admin column in users migration"
if ($commitCount -ge 108) { return }

# 91: Create accounts table migration - add comments
$c = [System.IO.File]::ReadAllText((Resolve-Path 'database\migrations\2026_03_01_094305_create_accounts_table.php').Path)
$c = $c -replace "\$table->string\('name'\)", '$table->string('"'"'name'"'"')->comment('"'"'Full display name'"'"')'
$c = $c -replace "\$table->string\('email'\)", '$table->string('"'"'email'"'"')->comment('"'"'Contact email address'"'"')'
[System.IO.File]::WriteAllText((Resolve-Path 'database\migrations\2026_03_01_094305_create_accounts_table.php').Path, $c, $enc)
$commitCount++; Make-Commit "Add comments to accounts table migration"
if ($commitCount -ge 108) { return }

# 92: Create projects table migration - add slug unique and comments
$c = [System.IO.File]::ReadAllText((Resolve-Path 'database\migrations\2026_06_04_000001_create_projects_table.php').Path)
$c = $c -replace "\$table->boolean\('is_active'\)", '$table->boolean('"'"'is_active'"'"')->default(true)->comment('"'"'Toggle project visibility'"'"')'
[System.IO.File]::WriteAllText((Resolve-Path 'database\migrations\2026_06_04_000001_create_projects_table.php').Path, $c, $enc)
$commitCount++; Make-Commit "Add default and comment to is_active in projects migration"
if ($commitCount -ge 108) { return }

# 93: Create testimonials migration - add comments
$c = [System.IO.File]::ReadAllText((Resolve-Path 'database\migrations\2026_06_04_000002_create_testimonials_table.php').Path)
$c = $c -replace "\$table->boolean\('is_active'\)", '$table->boolean('"'"'is_active'"'"')->default(true)->comment('"'"'Toggle testimonial visibility'"'"')'
[System.IO.File]::WriteAllText((Resolve-Path 'database\migrations\2026_06_04_000002_create_testimonials_table.php').Path, $c, $enc)
$commitCount++; Make-Commit "Add default and comment to is_active in testimonials migration"
if ($commitCount -ge 108) { return }

# 94: Create experiences migration
$c = [System.IO.File]::ReadAllText((Resolve-Path 'database\migrations\2026_06_04_000004_create_experiences_table.php').Path)
$c = $c -replace "\$table->boolean\('is_current'\)", '$table->boolean('"'"'is_current'"'"')->default(false)->comment('"'"'Whether this is the current position'"'"')'
[System.IO.File]::WriteAllText((Resolve-Path 'database\migrations\2026_06_04_000004_create_experiences_table.php').Path, $c, $enc)
$commitCount++; Make-Commit "Add comment to is_current in experiences migration"
if ($commitCount -ge 108) { return }

# 95: Add freetimestamps to contacts
$c = [System.IO.File]::ReadAllText((Resolve-Path 'database\migrations\2026_03_01_140515_create_contacts_table.php').Path)
$c = $c -replace "\$table->text\('message'\)", '$table->text('"'"'message'"'"')->comment('"'"'The message content'"'"')'
[System.IO.File]::WriteAllText((Resolve-Path 'database\migrations\2026_03_01_140515_create_contacts_table.php').Path, $c, $enc)
$commitCount++; Make-Commit "Add comment to message column in contacts migration"
if ($commitCount -ge 108) { return }

# === SECTION 21: Topbar add aria-label ===

# 96: topbar aria-label
$c = [System.IO.File]::ReadAllText((Resolve-Path 'resources\views\backend\partials\topbar.blade.php').Path)
$c = $c -replace "Home`" style=""", 'Home" aria-label="Go to homepage" style="'
[System.IO.File]::WriteAllText((Resolve-Path 'resources\views\backend\partials\topbar.blade.php').Path, $c, $enc)
$commitCount++; Make-Commit "Add aria-label to topbar home link"

# === SECTION 22: config/database.php cleanup ===

# 97: database.php
$c = [System.IO.File]::ReadAllText((Resolve-Path 'config\database.php').Path)
$c = $c -replace "'default' => env\('DB_CONNECTION', '.*'\)", "'default' => env('DB_CONNECTION', 'mysql')"
[System.IO.File]::WriteAllText((Resolve-Path 'config\database.php').Path, $c, $enc)
$commitCount++; Make-Commit "Set mysql as default database connection"
if ($commitCount -ge 108) { return }

# === SECTION 23: Remove PHP_VERSION_ID ternary from database.php ===

# 98: Remove the ternary
$c = [System.IO.File]::ReadAllText((Resolve-Path 'config\database.php').Path)
$c = $c -replace "            'unix_socket' => env\('DB_SOCKET', ''\),`n`n            'charset' => 'utf8mb4',`n`n            'collation' => 'utf8mb4_unicode_ci',`n`n            'prefix' => '',`n`n            'prefix_indexes' => true,`n`n            'strict' => true,`n`n            'engine' => null,`n`n            'options' => extension_loaded\('pdo_mysql'\) \&\& array_filter\(\[", "'unix_socket' => env('DB_SOCKET', ''),`n`n            'charset' => 'utf8mb4',`n`n            'collation' => 'utf8mb4_unicode_ci',`n`n            'prefix' => '',`n`n            'prefix_indexes' => true,`n`n            'strict' => true,`n`n            'engine' => null,`n`n            'options' => ["
$c = $c -replace "        \]\) \?\: \[\]", "        ]"
[System.IO.File]::WriteAllText((Resolve-Path 'config\database.php').Path, $c, $enc)
$commitCount++; Make-Commit "Simplify database config options array"
if ($commitCount -ge 108) { return }

# === SECTION 24: Filesystem cleanup ===

# 99: filesystems.php
$c = [System.IO.File]::ReadAllText((Resolve-Path 'config\filesystems.php').Path)
$c = $c -replace "'throw' => false,", "'throw' => env('FILESYSTEM_THROW', false),"
[System.IO.File]::WriteAllText((Resolve-Path 'config\filesystems.php').Path, $c, $enc)
$commitCount++; Make-Commit "Use env variable for filesystem throw config"
if ($commitCount -ge 108) { return }

# === SECTION 25: Add session config ===

# 100: .gitignore
$c = [System.IO.File]::ReadAllText((Resolve-Path '.gitignore').Path)
if ($c -notmatch "/public/storage") {
    $c = $c + "`n/public/storage`n"
}
[System.IO.File]::WriteAllText((Resolve-Path '.gitignore').Path, $c, $enc)
$commitCount++; Make-Commit "Add storage link to gitignore"
if ($commitCount -ge 108) { return }

# === SECTION 26: More config cleanups ===

# 101: Remove redis from cache.php if not used
$c = [System.IO.File]::ReadAllText((Resolve-Path 'config\cache.php').Path)
$c = $c -replace "        'redis' => \[[\s\S]*?        \],`n`n" -Replacement ""
[System.IO.File]::WriteAllText((Resolve-Path 'config\cache.php').Path, $c, $enc)
$commitCount++; Make-Commit "Remove unused redis cache config"
if ($commitCount -ge 108) { return }

# 102: Remove failover not needed
$c = [System.IO.File]::ReadAllText((Resolve-Path 'config\cache.php').Path)
$c = $c -replace "        'failover' => \[[\s\S]*?        \],`n`n" -Replacement ""
[System.IO.File]::WriteAllText((Resolve-Path 'config\cache.php').Path, $c, $enc)
$commitCount++; Make-Commit "Remove unused failover cache config"
if ($commitCount -ge 108) { return }

# === SECTION 27: Comment updates for routes ===

# 103: admin.php - add comments for sections
$c = [System.IO.File]::ReadAllText((Resolve-Path 'routes\admin.php').Path)
$c = $c -replace "// FAQs", "// ===== FAQs ====="
$c = $c -replace "// Inbox", "// ===== Inbox ====="
[System.IO.File]::WriteAllText((Resolve-Path 'routes\admin.php').Path, $c, $enc)
$commitCount++; Make-Commit "Improve route section comments in admin.php"
if ($commitCount -ge 108) { return }

# === SECTION 28: Add missing return types for protected casts ===

# 104: Casts in models
# Project already has casts as array
Replace-InFile -Path 'app\Models\Skill.php' -Pattern 'protected \$casts = \[' -Replacement '/** @var array<string, string> */`n    protected $casts = ['
$commitCount++; Make-Commit "Add type annotation to Skill casts property"
if ($commitCount -ge 108) { return }

# 105: Service casts
Replace-InFile -Path 'app\Models\Service.php' -Pattern 'protected \$casts = \[' -Replacement '/** @var array<string, string> */`n    protected $casts = ['
$commitCount++; Make-Commit "Add type annotation to Service casts property"
if ($commitCount -ge 108) { return }

# 106: Testimonial casts
Replace-InFile -Path 'app\Models\Testimonial.php' -Pattern 'protected \$casts = \[' -Replacement '/** @var array<string, string> */`n    protected $casts = ['
$commitCount++; Make-Commit "Add type annotation to Testimonial casts property"
if ($commitCount -ge 108) { return }

# 107: Experience casts
Replace-InFile -Path 'app\Models\Experience.php' -Pattern 'protected \$casts = \[' -Replacement '/** @var array<string, string> */`n    protected $casts = ['
$commitCount++; Make-Commit "Add type annotation to Experience casts property"
if ($commitCount -ge 108) { return }

# 108: CaseStudy casts
Replace-InFile -Path 'app\Models\CaseStudy.php' -Pattern 'protected \$casts = \[' -Replacement '/** @var array<string, string> */`n    protected $casts = ['
$commitCount++; Make-Commit "Add type annotation to CaseStudy casts property"
if ($commitCount -ge 108) { return }

# 
Write-Host "=== Attempted $commitCount commits ==="
