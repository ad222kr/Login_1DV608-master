<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-10-06
 * Time: 19:23
 */

namespace model\dal;


class TempCredentialsDAL {

    private static $pathToCookieCredentials = "data/user-cookies";

    /**
     * @param string, $username
     * @return string - the cookie password. Not really "temporary" yet..
     */
    public function getTempPassword($username) {

        $scanned_dir = array_diff(scandir(self::$pathToCookieCredentials), array("..", "."));

        foreach ($scanned_dir as $registeredName) { // file-handle is the username
            if ($username === $registeredName) {
                return file_get_contents(self::$pathToCookieCredentials . "/" . $username);
            }
        }
        return ""; // No exception since a user doesnt need a cookie-pw stored on the server
    }


    public function saveCookiePassword($username, $cookiePassword) {
        assert(is_string($username));
        assert(is_string($cookiePassword));
        file_put_contents(self::$pathToCookieCredentials . "/" . $username, $cookiePassword);
    }

}