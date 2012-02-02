<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');//SSL support
$config['ssl_support']		= (ENVIRONMENT != 'production') ? false : true;

//Business information
$config['company_name']		= 'Observant Records Shop';
$config['address1']			= '4009 Victory Dr.';
$config['address2']			= '#B204';
$config['country']			= 'US'; // use proper country codes only
$config['city']				= 'Austin'; 
$config['state']			= 'TX';
$config['zip']				= '78704';
$config['email']			= 'greg@observantrecords.com';

// Store currency
$config['currency']			= 'USD';  // USD, EUR, etc
$config['currency_symbol']  = '$';
//$config['currency_separator'] = ',';

// site logo path (for packing slip)
$config['site_logo']		= '/images/observant_records_logo.jpg';

//change the name of the admin controller folder 
$config['admin_folder']		= 'admin';

//file upload size limit
$config['size_limit']		= intval(ini_get('upload_max_filesize'))*1024;

//are new registrations automatically approved (true/false)
$config['new_customer_status']	= true;

//do we require customers to log in 
$config['require_login']		= true;

//default order status
$config['order_status']			= 'Pending';

$config['order_statuses']	= array(
	'Pending'  				=> 'Pending',
	'Processing'    		=> 'Processing',
	'Shipped'				=> 'Shipped',
	'On Hold'				=> 'On Hold',
	'Cancelled'				=> 'Cancelled'
);

// allow customers to purchase inventory flagged as out of stock?
$config['allow_os_purchase'] 	= true;

//do we tax according to shipping or billing address (acceptable strings are 'ship' or 'bill')
$config['tax_address']		= 'ship';

//do we tax the cost of shipping?
$config['tax_shipping']		= false;