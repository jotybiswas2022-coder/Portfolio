{{-- Shared section header: a "test suite" panel used by every home section.
     Params (all optional except hFile / hTitle):
       hFile     bar filename, e.g. 'services.php'
       hTag      small badge next to it, e.g. 'api'
       hCmd      command typed out in the prompt row
       hTitle    section heading (rendered as the suite name)
       hTests    array of assertion lines (usually just the subtitle)
       hTime     fake suite duration
       hRight    right-hand status badge in the title bar
       hSumRight right-hand text of the summary row
--}}
@php
    $hFile = $hFile ?? 'section.ts';
    $hTag = $hTag ?? 'ts';
    $hCmd = $hCmd ?? ('cat ' . $hFile);
    $hTitle = $hTitle ?? '';
    $hTests = $hTests ?? [];
    $hTime = $hTime ?? '0.42s';
    $hRight = $hRight ?? null;
    $hSumRight = $hSumRight ?? null;

    $hIcon = [
        'php' => 'bi-filetype-php',
        'md' => 'bi-markdown',
        'ts' => 'bi-filetype-tsx',
        'jsx' => 'bi-filetype-jsx',
        'sh' => 'bi-terminal',
        'git' => 'bi-git',
    ][pathinfo($hFile, PATHINFO_EXTENSION)] ?? 'bi-file-earmark-code';
@endphp

<div class="csh reveal" data-csh>
    <div class="csh-bar">
        <span class="ab-dot red"></span>
        <span class="ab-dot yellow"></span>
        <span class="ab-dot green"></span>
        <span class="csh-file"><i class="bi {{ $hIcon }}"></i> {{ $hFile }}</span>
        <span class="csh-tag">{{ $hTag }}</span>
        @if($hRight)
            <span class="csh-right"><span class="ab-dot2"></span> {{ $hRight }}</span>
        @endif
    </div>

    <div class="csh-cmd">
        <span class="csh-prompt">&#10095;</span>
        <span class="csh-cmd-text" data-cmd="{{ $hCmd }}"></span><span class="csh-caret"></span>
    </div>

    <div class="csh-body">
        <div class="csh-suite csh-anim" style="--d: 0">
            <span class="csh-pass"><i class="bi bi-check2"></i> PASS</span>
            <h2 class="csh-title">{{ $hTitle }}</h2>
            <span class="csh-time">{{ $hTime }}</span>
        </div>

        @if(count($hTests))
            <ul class="csh-tests">
                @foreach($hTests as $hTest)
                    <li class="csh-test csh-anim" style="--d: {{ $loop->index + 2 }}">
                        <span class="csh-check"><i class="bi bi-check-lg"></i></span>
                        <span>{{ $hTest }}</span>
                    </li>
                @endforeach
            </ul>
        @endif

        <div class="csh-summary csh-anim" style="--d: {{ count($hTests) + 2 }}">
            <span>Tests: <b>{{ count($hTests) }} passed</b>, {{ count($hTests) }} total</span>
            @if($hSumRight)
                <span class="csh-sum-right">{{ $hSumRight }}</span>
            @endif
        </div>
    </div>
</div>
