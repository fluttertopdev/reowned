<h2>Hello {{ $name }},</h2>

<p>
Thank you for contacting us. Here is the response to your query:
</p>

<p>
{!! nl2br(e($text)) !!}
</p>

<br>

<p>
Regards,<br>
<b>{{ setting('name') }} Team</b>
</p>