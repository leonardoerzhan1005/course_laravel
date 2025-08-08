<?php
/**
 * phpMyAdmin configuration file for SkillGro LMS
 */

// Server configuration
$cfg['Servers'][$i]['auth_type'] = 'config';
$cfg['Servers'][$i]['host'] = 'mysql';
$cfg['Servers'][$i]['port'] = '3306';
$cfg['Servers'][$i]['user'] = 'root';
$cfg['Servers'][$i]['password'] = 'root_password';

// Session settings
$cfg['LoginCookieValidity'] = 1440;
$cfg['LoginCookieStore'] = 0;
$cfg['LoginCookieDeleteAll'] = true;

// Interface settings
$cfg['DefaultLang'] = 'en';
$cfg['ServerDefault'] = 1;
$cfg['ShowPhpInfo'] = true;
$cfg['ShowChgPassword'] = true;
$cfg['ShowCreateDb'] = true;

// Upload settings
$cfg['UploadDir'] = '';
$cfg['SaveDir'] = '';
$cfg['MaxSizeForInputField'] = 100000000;
$cfg['MaxRows'] = 100;

// Theme settings
$cfg['ThemeDefault'] = 'pmahomme';
$cfg['ThemeManager'] = true;
$cfg['ThemePath'] = './themes';

// Query history
$cfg['QueryHistoryDB'] = true;
$cfg['QueryHistoryMax'] = 25;

// Export settings
$cfg['Export']['format'] = 'sql';
$cfg['Export']['compression'] = 'none';
$cfg['Export']['charset'] = 'utf-8';

// Import settings
$cfg['Import']['charset'] = 'utf-8';
$cfg['Import']['allow_interrupt'] = true;

// Navigation settings
$cfg['NavigationTreePointerEnable'] = true;
$cfg['NavigationTreeDisplayItemFilterMinimum'] = 30;
$cfg['NavigationTreeEnableGrouping'] = true;

// SQL query settings
$cfg['SQLQuery']['Edit'] = true;
$cfg['SQLQuery']['Explain'] = true;
$cfg['SQLQuery']['ShowAsPHP'] = true;
$cfg['SQLQuery']['Refresh'] = true;

// Error handling
$cfg['Error_Handler']['display'] = true;
$cfg['Error_Handler']['gather'] = true;

// Memory and execution limits
$cfg['MemoryLimit'] = '512M';
$cfg['MaxExecutionTime'] = 300;

// Security settings
$cfg['TrustedProxies'] = array();
$cfg['PmaAbsoluteUri'] = '';

// User permissions
$cfg['AllowUserDropDatabase'] = true;
$cfg['Confirm'] = true;
$cfg['LoginCookieStore'] = 0;
$cfg['LoginCookieValidity'] = 1440; 