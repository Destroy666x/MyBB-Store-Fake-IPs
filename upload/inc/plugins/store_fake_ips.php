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

if(!defined('IN_MYBB'))
{
	die('What are you doing?!');
}

function store_fake_ips_info()
{
    global $db, $lang;
	
	$lang->load('store_fake_ips_acp');
	
	// Configuration link
	$store_fake_ips_cfg = '<br />';
	$gid = $db->fetch_field($db->simple_select('settinggroups', 'gid', "name='store_fake_ips'"), 'gid');
	
	if($gid)
	{
		global $mybb;
		
		$store_fake_ips_cfg = '<a href="index.php?module=config&amp;action=change&amp;gid='.$gid.'">'.$lang->configuration.'</a>
<br />';
		if(filter_var($mybb->settings['store_fake_ips_ip'], FILTER_VALIDATE_IP))
			$store_fake_ips_cfg .= <<<SFI
<form action="index.php?module=config-plugins&amp;action=fake_current_ips" method="post">
	<input type="hidden" name="my_post_key" value="{$mybb->post_code}" />
	<input type="hidden" name="fake_confirm" value="yes" />
	<a href="#" onclick="$(this).closest('form').submit(); return false">{$lang->store_fake_ips_current}</a>
</form>
SFI;
		$store_fake_ips_cfg .= '
<br />';
	}
	
	return array(
		'name'			=> $lang->store_fake_ips,
		'description'	=> $lang->store_fake_ips_info.'<br />
'.$store_fake_ips_pl.$store_fake_ips_cfg.'
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="ZRC6HPQ46HPVN">
<input type="image" src="https://www.paypalobjects.com/en_GB/i/btn/btn_donate_SM.gif" style="border: 0;" name="submit" alt="Donate">
<img alt="" src="https://www.paypalobjects.com/pl_PL/i/scr/pixel.gif" style="border: 0; width: 1px; height: 1px;">
</form>',
		'website'		=> 'https://github.com/Destroy666x',
		'author'		=> 'Destroy666',
		'authorsite'	=> 'https://github.com/Destroy666x',
		'version'		=> 1.0,
		'codename'		=> 'store_fake_ips',
		'compatibility'	=> '18*'
    );
}


function store_fake_ips_activate()
{
	global $db, $lang;
	
	$lang->load('store_fake_ips_acp');
	
	// Settings
	if(!$db->fetch_field($db->simple_select('settinggroups', 'COUNT(1) AS cnt', "name ='store_fake_ips'"), 'cnt'))
	{
		$store_fake_ips_settinggroup = array(
			'gid'			=> NULL,
			'name'			=> 'store_fake_ips',
			'title'			=> $db->escape_string($lang->store_fake_ips),
			'description'	=> $db->escape_string($lang->store_fake_ips_settings),
			'disporder'		=> 666,
			'isdefault'		=> 0
		); 
		
		$db->insert_query('settinggroups', $store_fake_ips_settinggroup);
		
		$store_fake_ips_setting = array(
			'name'			=> 'store_fake_ips_ip',
			'title'			=> $db->escape_string($lang->store_fake_ips_ip),
			'description'	=> $db->escape_string($lang->store_fake_ips_ip_desc),
			'optionscode'	=> 'text',
			'value'			=> '127.0.0.1',
			'sid'			=> NULL,
			'disporder'		=> 0,
			'gid'			=> $db->insert_id()
		);
		
		$db->insert_query('settings', $store_fake_ips_setting);
		
		rebuild_settings();
	}
}

function store_fake_ips_deactivate()
{
	global $db;
	
	$db->delete_query('settings', "name = 'store_fake_ips_ip'");
	$db->delete_query('settinggroups', "name = 'store_fake_ips'");
	
	rebuild_settings();
}

$plugins->add_hook('admin_config_plugins_begin', 'store_fake_ips_change_current');

function store_fake_ips_change_current()
{
	global $mybb;
	
	if($mybb->get_input('action') == 'fake_current_ips' && $mybb->request_method == 'post')
	{
		global $lang;
		
		$lang->load('store_fake_ips_acp');
		
		if($mybb->get_input('fake_confirm') == 'yes')
			$GLOBALS['page']->output_confirm_action('index.php?module=config-plugins&action=fake_current_ips', $lang->store_fake_ips_confirm, $lang->store_fake_ips_confirm_title);
		
		if(!$mybb->get_input('no'))
		{
			// Make use of the binary fields array in which all IP columns are stored, available only in 1.8.x
			if(!empty($mybb->binary_fields))
			{
				if(filter_var($mybb->settings['store_fake_ips_ip'], FILTER_VALIDATE_IP))
				{
					global $db;
					
					foreach($mybb->binary_fields as $table => $fields)
					{
						foreach($fields as &$field)
							$field = $db->escape_binary(my_inet_pton($mybb->settings['store_fake_ips_ip']));
						$db->update_query($table, $fields);
					}
					
					flash_message($lang->store_fake_ips_done, 'success');
				}
				else
					flash_message($lang->store_fake_ips_wrong_ip, 'error');
			}
			else
				flash_message($lang->store_fake_ips_wrong_version, 'error');
		}
			
		admin_redirect('index.php?module=config-plugins');
	}
}

$plugins->add_hook('get_ip', 'store_fake_ips_change_new');

function store_fake_ips_change_new($ip_arr)
{
	global $mybb;
	
	if(filter_var($mybb->settings['store_fake_ips_ip'], FILTER_VALIDATE_IP))
		$ip_arr['ip'] = $mybb->settings['store_fake_ips_ip'];
}

$plugins->add_hook('moderation_purgespammer_purge', 'store_fake_ips_dont_ban');

function store_fake_ips_dont_ban()
{
	global $user;
	
	// Just to avoid banning everyone on the forum and make Purge Spammer still usable...
	$user['regip'] = $user['lastip'] = '';
}

$plugins->add_hook('admin_config_banning_add', 'store_fake_ips_dont_ban_acp');

function store_fake_ips_dont_ban_acp()
{
	global $mybb;
	
	if($mybb->get_input('type', MyBB::INPUT_INT) == 1)
	{
		// Borrowed from inc/functions.php to check ranges just like the is_banned_ip() function..
		$unbanable = false;
		$ip_range = fetch_ip_range($mybb->get_input('filter'));
		$ip = my_inet_pton($mybb->settings['store_fake_ips_ip']);
		if(is_array($ip_range))
		{
			if(strcmp($ip_range[0], $ip) <= 0 && strcmp($ip_range[1], $ip) >= 0)
			{
				$unbanable = true;
			}
		}
		elseif($ip == $ip_range)
		{
			$unbanable = true;
		}
		
		if($unbanable)
		{
			global $lang;
			
			$lang->load('store_fake_ips_acp');
			
			$GLOBALS['errors'][] = $lang->store_fake_ips_dont_ban;
		}
	}
}