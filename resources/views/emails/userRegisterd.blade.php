@component('mail::message')
# Hello {{ $UserName }},
<br>

Welcome to blacklist our service is an alternative database for chronic debtors and fraudulent people as reported by verified registered Nigerian businesses. Any verified registered business in Nigeria is free to upload a list of their debtors or business associates, employee or customers that have defrauded them.


@component('mail::button', ['url' => 'https://blacklistng.com/'])
Visit Blacklist
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
