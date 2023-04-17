{{-- Skills & Expertise Tags --}}

@props(['tagsCsv'])
<!-- Csv means comma separated value. Ex: laravel, api, backend -->

@php
    $tags = explode(',', $tagsCsv); //https://www.w3schools.com/php/func_string_explode.asp
@endphp


@foreach ($tags as $tag)
    <li>
        <a class="tags-btn-lookalike">{{ $tag }}</a>
        <!-- Pass as query parameters: https://www.branch.io/glossary/query-parameters/#:~:text=Query%20parameters%20are%20a%20defined,immediately%20by%20a%20query%20parameter. -->
    </li>
    <!-- Pass as query parameters: https://www.branch.io/glossary/query-parameters/#:~:text=Query%20parameters%20are%20a%20defined,immediately%20by%20a%20query%20parameter. -->
@endforeach
