<?php
$file = 'index.blade.php';
$content = file_get_contents($file);

// ====== CHANGE 1: Replace the Gigs CSS section ======
$oldStart = '/* Gigs */
    .gigs-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 1.8rem;
    }
    .gig-card {
        display: block;
        text-decoration: none;
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-lg);
        overflow: hidden;
        transition: var(--transition);
    }
    html.light-theme .gig-card { background: rgba(255, 255, 255, 0.92); }
    .gig-card:hover {
        border-color: var(--border-hover);
        box-shadow: var(--shadow-md);
        transform: translateY(-6px);
    }
    .gig-image {
        height: 220px;
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .gig-image .gig-icon { font-size: 4rem; opacity: 0.5; transition: var(--transition); }
    .gig-card:hover .gig-image .gig-icon { transform: scale(1.3); opacity: 1; }
    .gig-image img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease; }
    .gig-card:hover .gig-image img { transform: scale(1.08); }
    .gig-image::after {
        content: '';
        position: absolute;
        bottom: 0; left: 0; right: 0;
        height: 70px;
        background: linear-gradient(transparent, rgba(30, 41, 59, 0.95));
    }
    html.light-theme .gig-image::after { background: linear-gradient(transparent, rgba(255, 255, 255, 0.95)) !important; }
    .gig-body { padding: 1.5rem; }
    .gig-body h3 { font-size: 1.2rem; font-weight: 700; margin-bottom: 0.4rem; color: var(--text-primary); }
    .gig-body p { color: var(--text-secondary); font-size: 0.9rem; line-height: 1.6; margin-bottom: 0.8rem; }
    .gig-price-badge {
        display: inline-block;
        padding: 0.3rem 1rem;
        background: rgba(59, 130, 246, 0.12);
        color: var(--accent-light);
        border: 1px solid rgba(59, 130, 246, 0.25);
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
    }';

$newStart = '/* ===== GIGS — MODERN GLASS GRID ===== */
    .gigs-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.8rem;
        justify-content: center;
        justify-items: center;
    }
    /* Center single card */
    .gigs-grid > :only-child {
        grid-column: 2 / 3;
    }
    .gig-card {
        display: block;
        text-decoration: none;
        background: var(--bg-card);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-xl);
        overflow: hidden;
        transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        width: 100%;
        max-width: 380px;
        position: relative;
    }
    html.light-theme .gig-card { background: rgba(255, 255, 255, 0.85); }
    .gig-card:hover {
        border-color: var(--border-hover);
        box-shadow: 0 20px 60px rgba(59, 130, 246, 0.1), 0 0 40px rgba(59, 130, 246, 0.04);
        transform: translateY(-8px);
    }
    /* Gradient top border on hover */
    .gig-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 3px;
        background: linear-gradient(90deg, transparent, var(--accent), #8b5cf6, transparent);
        opacity: 0;
        transition: opacity 0.5s ease;
        z-index: 5;
    }
    .gig-card:hover::before { opacity: 1; }
    .gig-image {
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        aspect-ratio: 16 / 9;
    }
    .gig-image .gig-icon { font-size: 4rem; opacity: 0.5; transition: var(--transition); }
    .gig-card:hover .gig-image .gig-icon { transform: scale(1.3); opacity: 1; }
    .gig-image img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.7s cubic-bezier(0.16, 1, 0.3, 1); }
    .gig-card:hover .gig-image img { transform: scale(1.08); }
    .gig-image::after {
        content: '';
        position: absolute;
        bottom: 0; left: 0; right: 0;
        height: 50%;
        background: linear-gradient(transparent, rgba(10, 15, 30, 0.85));
        pointer-events: none;
        z-index: 1;
    }
    html.light-theme .gig-image::after { background: linear-gradient(transparent, rgba(248, 250, 252, 0.9)) !important; }
    .gig-body { padding: 1.5rem 1.5rem 1.8rem; position: relative; z-index: 2; }
    .gig-body h3 { font-size: 1.2rem; font-weight: 700; margin-bottom: 0.4rem; color: var(--text-primary); }
    .gig-body p { color: var(--text-secondary); font-size: 0.9rem; line-height: 1.6; margin-bottom: 1rem; }
    .gig-price-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.4rem 1.1rem;
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.12), rgba(139, 92, 246, 0.08));
        color: var(--accent-light);
        border: 1px solid rgba(59, 130, 246, 0.2);
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 700;
        transition: all 0.3s ease;
    }
    .gig-card:hover .gig-price-badge {
        background: var(--accent-gradient);
        border-color: transparent;
        color: #fff;
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
    }';

$pos = strpos($content, $oldStart);
if ($pos === false) {
    echo "ERROR: Could not find old Gigs CSS section\n";
    exit(1);
}
$content = substr_replace($content, $newStart, $pos, strlen($oldStart));
echo "OK: Gigs CSS section replaced\n";

// ====== CHANGE 2: Responsive 768px ======
$old768 = '        .gigs-grid { grid-template-columns: repeat(auto-fill, minmax(240px, 1fr)); gap: 1.4rem; }';
$new768 = '        .gigs-grid { grid-template-columns: repeat(2, 1fr); gap: 1.2rem; }';
$count = 0;
$content = str_replace($old768, $new768, $content, $count);
echo "OK: 768px responsive updated (count: $count)\n";

// ====== CHANGE 3: Responsive 480px ======
$old480 = '        .gigs-grid { grid-template-columns: 1fr; gap: 1.2rem; }';
$new480 = '        .gigs-grid { grid-template-columns: 1fr; gap: 1rem; }';
$count = 0;
$content = str_replace($old480, $new480, $content, $count);
echo "OK: 480px responsive updated (count: $count)\n";

// ====== CHANGE 4: Update HTML ======
$oldHtml = '                    <a href="{{ route(\'gig.detail\', $gig->id) }}" class="gig-card reveal reveal-delay-{{ $delay }}" style="filter: drop-shadow(0 4px 30px rgba(59, 130, 246, 0.15));">
                        <div class="gig-image" style="background: {{ $gradients[$index % count($gradients)] }};">
                            @if($gig->image)
                                <img src="{{ config(\'app.storage_url\') }}{{ $gig->image }}" alt="{{ $gig->title }}">
                            @else
                                <i class="{{ $icons[$index % count($icons)] }} gig-icon"></i>
                            @endif
                        </div>
                        <div class="gig-body">
                            <h3>{{ $gig->title }}</h3>
                            @if($gig->short_description)
                                <p>{{ $gig->short_description }}</p>
                            @endif
                            <span class="gig-price-badge">
                                {{ $gig->basic_price }} USD
                            </span>
                        </div>
                    </a>';

$newHtml = '                    <a href="{{ route(\'gig.detail\', $gig->id) }}" class="gig-card reveal reveal-delay-{{ $delay }}">
                        <div class="gig-image" style="background: {{ $gradients[$index % count($gradients)] }};">
                            @if($gig->image)
                                <img src="{{ config(\'app.storage_url\') }}{{ $gig->image }}" alt="{{ $gig->title }}">
                            @else
                                <i class="{{ $icons[$index % count($icons)] }} gig-icon"></i>
                            @endif
                        </div>
                        <div class="gig-body">
                            <h3>{{ $gig->title }}</h3>
                            @if($gig->short_description)
                                <p>{{ $gig->short_description }}</p>
                            @endif
                            <span class="gig-price-badge">
                                <i class="bi bi-currency-dollar"></i>
                                {{ $gig->basic_price }} USD
                            </span>
                        </div>
                    </a>';

$pos2 = strpos($content, $oldHtml);
if ($pos2 === false) {
    // Try without style attribute
    $oldHtml2 = '                    <a href="{{ route(\'gig.detail\', $gig->id) }}" class="gig-card reveal reveal-delay-{{ $delay }}">
                        <div class="gig-image" style="background: {{ $gradients[$index % count($gradients)] }};">
                            @if($gig->image)
                                <img src="{{ config(\'app.storage_url\') }}{{ $gig->image }}" alt="{{ $gig->title }}">
                            @else
                                <i class="{{ $icons[$index % count($icons)] }} gig-icon"></i>
                            @endif
                        </div>
                        <div class="gig-body">
                            <h3>{{ $gig->title }}</h3>
                            @if($gig->short_description)
                                <p>{{ $gig->short_description }}</p>
                            @endif
                            <span class="gig-price-badge">
                                {{ $gig->basic_price }} USD
                            </span>
                        </div>
                    </a>';
    if (strpos($content, $oldHtml2) !== false) {
        echo "Found HTML without style attr\n";
        $content = str_replace($oldHtml2, $newHtml, $content);
        echo "OK: Gig card HTML replaced (no style)\n";
    } else {
        echo "ERROR: Could not find old gig card HTML\n";
        // Debug: show what's around the gig card
        $search = 'class="gig-card reveal';
        $pos3 = strpos($content, $search);
        if ($pos3 !== false) {
            echo "Found at $pos3: " . substr($content, $pos3, 500) . "\n";
        }
        exit(1);
    }
} else {
    $content = substr_replace($content, $newHtml, $pos2, strlen($oldHtml));
    echo "OK: Gig card HTML replaced (with style)\n";
}

// Save
file_put_contents($file, $content);
echo "DONE: File saved successfully\n";
