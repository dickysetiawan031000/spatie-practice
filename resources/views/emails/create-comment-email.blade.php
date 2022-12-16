@component('mail::message')
# Introduction

New Comment added in your News.

{{ $comment->comment }}

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
