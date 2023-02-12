<?php
$aMenu[] = array(
    "parent_menu" => "global_menu_settings",
    "sort" => 1800,
    "text" => 'test',
    "title" => 'test2',
    "url" => "tools_index.php?lang=".LANGUAGE_ID,
    "icon" => "util_menu_icon",
    "page_icon" => "util_page_icon",
    "items_id" => "menu_util",
    "items" => array(
        array(
            "text" => GetMessage("MAIN_MENU_SITE_CHECKER"),
            "url" => "site_checker.php?lang=".LANGUAGE_ID,
            "more_url" => array(),
            "title" => GetMessage("MAIN_MENU_SITE_CHECKER_ALT"),
        ),
        array(
            "text" => GetMessage("MAIN_MENU_FILE_CHECKER"),
            "url" => "file_checker.php?lang=".LANGUAGE_ID,
            "more_url" => array(),
            "title" => GetMessage("MAIN_MENU_FILE_CHECKER_ALT"),
        ),
        array(
            "text" => GetMessage("MAIN_MENU_PHPINFO"),
            "url" => "phpinfo.php?test_var1=AAA&test_var2=BBB",
            "more_url" => array("phpinfo.php"),
            "title" => GetMessage("MAIN_MENU_PHPINFO_ALT"),
        ),
        array(
            "text" => GetMessage("MAIN_MENU_SQL"),
            "url" => "sql.php?lang=".LANGUAGE_ID."&del_query=Y",
            "more_url" => array("sql.php"),
            "title" => GetMessage("MAIN_MENU_SQL_ALT"),
        ),
        array(
            "text" => GetMessage("MAIN_MENU_PHP"),
            "url" => "php_command_line.php?lang=".LANGUAGE_ID."",
            "more_url" => array("php_command_line.php"),
            "title" => GetMessage("MAIN_MENU_PHP_ALT"),
        ),
        array(
            "text" => GetMessage("MAIN_MENU_AGENT"),
            "url" => "agent_list.php?lang=".LANGUAGE_ID,
            "more_url" => array("agent_list.php", "agent_edit.php"),
            "title" => GetMessage("MAIN_MENU_AGENT_ALT"),
        ),
        array(
            "text" => GetMessage("MAIN_MENU_DUMP"),
            "url" => "dump.php?lang=".LANGUAGE_ID,
            "more_url" => array("dump.php", "restore_export.php"),
            "title" => GetMessage("MAIN_MENU_DUMP_ALT"),
        ),
        (strtoupper($DBType) == "MYSQL"?
            Array(
                "text" => GetMessage("MAIN_MENU_REPAIR_DB"),
                "url" => "repair_db.php?lang=".LANGUAGE_ID,
                "more_url" => array(),
                "title" => GetMessage("MAIN_MENU_REPAIR_DB_ALT"),
            )
            :null
        ),
        ($USER->CanDoOperation('view_event_log')?
            Array(
                "text" => GetMessage("MAIN_MENU_EVENT_LOG"),
                "url" => "event_log.php?lang=".LANGUAGE_ID,
                "more_url" => array(),
                "title" => GetMessage("MAIN_MENU_EVENT_LOG_ALT"),
            )
            :null
        ),
    ),
);
