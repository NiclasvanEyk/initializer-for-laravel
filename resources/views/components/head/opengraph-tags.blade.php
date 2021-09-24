@props(['url', 'image', 'title', 'description'])

@php
    $host = parse_url($url)['host'];
@endphp

<!-- Facebook Meta Tags -->
<meta property="og:url" content="{{ $url }}">
<meta property="og:type" content="website">
<meta property="og:title" content="{{ $title }}">
<meta property="og:description" content="{{ $description }}">
<meta property="og:image" content="{{ $image }}">

<!-- Twitter Meta Tags -->
<meta name="twitter:card" content="summary_large_image">
<meta property="twitter:domain" content="{{ $host }}">
<meta property="twitter:url" content="{{ $url }}">
<meta name="twitter:title" content="{{ $title }}">
<meta name="twitter:description" content="{{ $description }}">
<meta name="twitter:image" content="{{ $image }}">

<!-- Meta Tags Generated via https://www.opengraph.xyz -->