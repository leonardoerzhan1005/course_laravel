<?php
/**
 * phpMyAdmin configuration file for SkillGro LMS
 */


$cfg['Servers'][$i]['auth_type'] = 'config';
$cfg['Servers'][$i]['host'] = 'mysql';
$cfg['Servers'][$i]['port'] = '3306';
$cfg['Servers'][$i]['user'] = 'erzhan';
$cfg['Servers'][$i]['password'] = '!Gro@2025';


$cfg['LoginCookieValidity'] = 1440;
$cfg['LoginCookieStore'] = 0;
$cfg['LoginCookieDeleteAll'] = true;


$cfg['DefaultLang'] = 'en';
$cfg['ServerDefault'] = 1;
$cfg['ShowPhpInfo'] = true;
$cfg['ShowChgPassword'] = true;
$cfg['ShowCreateDb'] = true;

$cfg['UploadDir'] = '';
$cfg['SaveDir'] = '';
$cfg['MaxSizeForInputField'] = 100000000;
$cfg['MaxRows'] = 100;


$cfg['ThemeDefault'] = 'pmahomme';
$cfg['ThemeManager'] = true;
$cfg['ThemePath'] = './themes';


$cfg['QueryHistoryDB'] = true;
$cfg['QueryHistoryMax'] = 25;


$cfg['Export']['format'] = 'sql';
$cfg['Export']['compression'] = 'none';
$cfg['Export']['charset'] = 'utf-8';


$cfg['Import']['charset'] = 'utf-8';
$cfg['Import']['allow_interrupt'] = true;


$cfg['NavigationTreePointerEnable'] = true;
$cfg['NavigationTreeDisplayItemFilterMinimum'] = 30;
$cfg['NavigationTreeEnableGrouping'] = true;


$cfg['SQLQuery']['Edit'] = true;
$cfg['SQLQuery']['Explain'] = true;
$cfg['SQLQuery']['ShowAsPHP'] = true;
$cfg['SQLQuery']['Refresh'] = true;


$cfg['Error_Handler']['display'] = true;
$cfg['Error_Handler']['gather'] = true;


$cfg['MemoryLimit'] = '512M';
$cfg['MaxExecutionTime'] = 300;


$cfg['TrustedProxies'] = array();
$cfg['PmaAbsoluteUri'] = '';


$cfg['AllowUserDropDatabase'] = false;
$cfg['Confirm'] = true;
$cfg['LoginCookieStore'] = 0;
$cfg['LoginCookieValidity'] = 1440; 