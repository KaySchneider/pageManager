<?php

/**
 * This class provides static methods that return pieces of data specific to
 * your app
 */
class AppInfo {

    static $databaseHost = null;
    static $databaseUser = null;
    static $databasePass = null;
    static $databaseBase = null;

    /*     * ***************************************************************************
     *
     * These functions provide the unique identifiers that your app users.  These
     * have been pre-populated for you, but you may need to change them at some
     * point.  They are currently being stored in 'Environment Variables'.  To
     * learn more about these, visit
     *   'http://php.net/manual/en/function.getenv.php'
     *
     * ************************************************************************** */

    /**
     * @return the appID for this app
     */
    public static function appID() {
        return getenv('FACEBOOK_APP_ID');
    }

    /**
     * @return the appSecret for this app
     */
    public static function appSecret() {
        return getenv('FACEBOOK_SECRET');
    }

    /**
     * @return the database config
     *  
     */
    public static function dataBaseUser() {
        if (AppInfo::$databaseUser == null) {
            AppInfo::parseDBData();
        }

        return AppInfo::$databaseUser;
    }

    public static function dataBasePass() {
        if (AppInfo::$databasePass == null) {
            AppInfo::parseDBData();
        }

        return AppInfo::$databasePass;
    }

    public static function dataBaseHost() {
        if (AppInfo::$databaseHost == null) {
            AppInfo::parseDBData();
        }

        return AppInfo::$databaseHost;
    }

    public static function dataBaseBase() {
        if (AppInfo::$databaseBase == null) {
            AppInfo::parseDBData();
        }

        return AppInfo::$databaseBase;
    }

    /**
     * this static private method parses the database connection 
     * from heroku config with getEnv and saved this as static
     * var in the appInfo
     * 
     * @return parse the database connection 
     */
    private static function parseDBData() {
        $databaseHeroku = getenv('CLEARDB_DATABASE_URL_A');
        $moreDiff = explode("@", $databaseHeroku);

        $userPass = explode(":", str_replace("mysql://", "", $moreDiff[0]));

        AppInfo::$databaseUser = $userPass[0];
        AppInfo::$databasePass = $userPass[1];

        $hostBase = explode("/", str_replace("@", "", $moreDiff[1]));
        AppInfo::$databaseHost = $hostBase[0];

        //$clearBase = str_replace("heroku_", "", $hostBase[1]);
        AppInfo::$databaseBase = $hostBase[1];
    }

    /**
     * @return the home URL for this site
     */
    public static function getHome() {
        return ($_SERVER['HTTP_X_FORWARDED_PROTO'] ? : "http") . "://" . $_SERVER['HTTP_HOST'] . "/";
    }

}
