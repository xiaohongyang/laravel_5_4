@component('mail::message')
# Introduction

您好, {{$user->name}}

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

@component('mail::table')
| Laravel       | Table         | Example  |
| ------------- |:-------------:| --------:|
| Col 2 is      | Centered      | $10      |
| Col 3 is      | Right-Aligned | $20      |
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

@component('mail::panel')
This is panel component
@endcomponent
