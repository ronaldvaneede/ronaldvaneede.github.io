---
title: Tools
description: The tools I use on a daily bases for my work and personally
---
@extends('_layouts.main')

@section('body')
    <h1>Tools</h1>
    
    <div class="grid grid-cols-2 md:grid-cols-3 gap-x-12">
        @foreach ($tools as $tool)
            @include('_components.tool-preview-inline')
        @endforeach
    </div>
@stop
