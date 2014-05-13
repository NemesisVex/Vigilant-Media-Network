<?xml version="1.0" encoding="UTF-8"?>
<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:sy="http://purl.org/rss/1.0/modules/syndication/" xmlns:admin="http://webns.net/mvcb/" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#">
<channel>
<title>Austin Stories</title>
<link>http://www.austin-stories.com/</link>
<description>a portal for austin-based online journal writers</description>
<dc:language>en-us</dc:language>
{foreach item=rsItem from=$rsItems}
<item>
<title><![CDATA[{$rsItem.portal_headline}]]></title>
<link>{$rsItem.portal_url}</link>
<description><![CDATA[{$rsItem.portal_body_text}]]></description>
<guid>{$rsItem.portal_url}</guid>
<dc:creator>{$rsItem.user_display_name}</dc:creator>
<dc:subject>{$rsItem.site_name}</dc:subject>
<dc:date>{$rsItem.portal_date_added}</dc:date>
</item>
{/foreach}
</channel>
</rss>
