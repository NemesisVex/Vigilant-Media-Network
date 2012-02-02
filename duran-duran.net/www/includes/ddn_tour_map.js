var map;

function initialize()
{
	if (GBrowserIsCompatible())
	{
		map = new GMap2(document.getElementById("map_canvas"));
		map.setUIToDefault();
	}
}

function set_center(point)
{
	map.setCenter(point, 4);
}

function create_marker(point, date_id, link)
{
	var marker = new GMarker(point);
	get_tour_info(date_id, marker, link);
	map.addOverlay(marker);
}

function create_dom_marker(element)
{
	var marker = new GMarker(point);
	get_tour_info(date_id, marker, element);
}

function create_marker_listener(marker, html)
{
	GEvent.addListener(marker, 'click', function() {
		marker.openInfoWindowHtml(html);
	});
}

function create_dom_listener(element, marker, html)
{
	GEvent.addDomListener(element, 'click', function() {
		marker.openInfoWindowHtml(html);
	});
}

function get_tour_info(date_id, marker, element)
{
	var msg;
	var url = '/index.php/tour/marker/' + date_id + '/';
	//alert(url);

	$.ajax(
	{
		type: "POST",
		url: url,
		success: function (msg) {
			create_marker_listener(marker, msg);
			if (element)
			{
				create_dom_listener(element, marker, msg);
			}
		}
	});
}

$(document).ready(function () {
	initialize();
    $('#mycarousel').jcarousel({
		visible: 3
    });
	$('#tour_dates').jScrollPane({
		scrollbarWidth: 15
	});
});

$(document).unload(function() {
	GUnload();
})

