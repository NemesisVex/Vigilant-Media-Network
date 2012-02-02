<h1>Attendees</h1>

<p>Insert Your Name Here! Here are the registered attendees and their websites.
</p>
<p>
Registered attendees will have the opportunity to select from custom banners
and buttons to display on their sites.  Anyone else that is interested is
welcome to help promote the conference by taking these <a href="/link.php">general buttons</a>; feel
free to link to the images on our server, as long as you are linking back to
the JCon '03 home page.
</p>

{if $rsAttendees}
{foreach item=rsAttendee from=$rsAttendees}
<b>{$rsAttendee->BadgeName}</b>{if $rsAttendee->SiteName} of <i><a href="{$rsAttendee->URL}">{$rsAttendee->SiteName}</a></i>{/if}<br>
{/foreach}
{/if}