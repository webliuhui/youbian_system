<?php
include_once dirname(dirname(__FILE__)).'/global_inc.php';

$userInfo = json_decode($_SESSION['user_info'] , true);

$display = new lib_display();
$display->header->setHeader('head.tpl.php');
$display->header->setTitle('版本概况');

$display->setBody('struct/manage_system.tpl.php');
$display->addModule('top','module/top.module.php','manage_system_top.php');
$display->addModule('left','module/left.module.php','manage_system_left.php');
//主页面
$contentModule = new lib_module('base/base_curriculumn_detail.module.php');

//jquery_tips加载
$contentModule->addCSS('/manage_system/js/jquery_tips/tip-twitter/tip-twitter.css');
$contentModule->addJavaScript('/manage_system/js/jquery_tips/jquery.poshytip.min.js');

//加载当前页JS数据处理
$contentModule->addJavaScript('/manage_system/js/base/base_curriculumn_detail_handler.js');


$content_views = array();

//查询版本信息

$sourceTypes = factory::getModel('edu_source_type')->get_source_types();
// $curriculumns = factory::getModel('edu_curriculumn_version')->get_curriculumn_versions_by_control($userInfo['id']);

$content_views['sourceType'] = $sourceTypes;

$contentModule->setView( $content_views );
// $contentModule->addModule('searchBar', 'module/source/search_bar.module.php' , 'source/search_bar_for_knowledge&zhuanti.php');
// $contentModule->addModule('treeSetting' , 'module/source/tree_setting.module.php' , 'source/tree_setting.php');
// $contentModule->addModule('treeHTML' , 'module/source/tree_html.module.php' , 'source/tree_data.php');
$contentModule->addModule('pagerHTML' , 'module/source/pager_html.module.php' , array('pager'=>array('type'=>'js','totalcount'=>0,'offset'=>0,'step'=>10,'linkMax'=>2)));
// $contentModule->addModule('questionListSetting' , 'module/source/question_list_setting.module.php' , 'source/question_list_setting.php');
// $contentModule->addModule('questionList' , 'module/source/question_list.module.php');
$contentModule->addModule('popPanels' , 'popup/base/popup_base_curriculumn.php' , 'popup/base/popup_base_curriculumn.php');
$display->addModuleObject('content',$contentModule);

$display->footer->setFooter('foot.tpl.php');
$display->render();