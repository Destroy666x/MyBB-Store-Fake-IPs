<?php

/*
Name: Store Fake IPs
Author: Destroy666
Version: 1.0
Info: Plugin for MyBB forum software, coded for versions 1.8.x.
It stores every new IPs as an IP specified in a setting. Also makes it possible to convert all current IPs to it.  
1 new setting
Released under GNU GPL v3, 29 June 2007. Read the LICENSE.md file for more information.
Support: official MyBB forum - http://community.mybb.com/mods.php?action=profile&uid=58253 (don't PM me, post on forums)
Bug reports: my github - https://github.com/Destroy666x

© 2015 - date("Y")
*/

$l['store_fake_ips'] = 'Store Fake IPs';
$l['store_fake_ips_info'] = 'Stores every new IPs as an IP specified in a setting. Also makes it possible to convert all current IPs to it.';

$l['store_fake_ips_settings'] = 'Settings for the Store Fake IPs plugin.';
$l['store_fake_ips_ip'] = 'Fake IP';
$l['store_fake_ips_ip_desc'] = "Enter a valid IPv4 or IPv6 address, for example 127.0.0.1. If the IP isn't correct, the plugin won't work.";

$l['store_fake_ips_current'] = 'Fake all current IPs stored in the database.';
$l['store_fake_ips_confirm'] = "Do you surely want to fake every IP in the database? This action can't be reverted.";
$l['store_fake_ips_confirm_title'] = 'Fake All IPs?';
$l['store_fake_ips_done'] = 'The IPs have been successfully faked.';
$l['store_fake_ips_wrong_ip'] = 'The IP you entered in settings is incorrect. Make sure to use a proper IPv6 or IPv4 address.';
$l['store_fake_ips_wrong_version'] = 'You need to upgrade to at least MyBB 1.8.0 to use this plugin.';
$l['store_fake_ips_dont_ban'] = "You can't ban this IP, otherwise everyone on the forum will be banned.";