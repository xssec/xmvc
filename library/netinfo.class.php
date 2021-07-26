<?php
class NetInfo {
  /**
  * Class to get user information
  * use:
    * $env = new NetInfo($_SERVER['HTTP_USER_AGENT']);

    * echo $env->ip();
    * echo $env->browser();
    * echo $env->platform();
    * echo $env->system();
  **/

  //ASSIGN VARIABLES TO USER INFO
  /**
   * Retrieves the best guess of the client's actual IP address.
   * Takes into account numerous HTTP proxy headers due to variations
   * in how different ISPs handle IP addresses in headers between hops.
   */
  public static function ip(){
    // check for shared internet/ISP IP
    if (!empty($_SERVER['HTTP_CLIENT_IP']) && NetInfo::validate_ip($_SERVER['HTTP_CLIENT_IP'])) {
      return $_SERVER['HTTP_CLIENT_IP'];
    }
    // check for IPs passing through proxies
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
      // check if multiple ips exist in var
      if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',') !== false) {
        $iplist = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        foreach ($iplist as $ip) {
          if (NetInfo::validate_ip($ip))
            return $ip;
        }
      } else {
        if (NetInfo::validate_ip($_SERVER['HTTP_X_FORWARDED_FOR']))
          return $_SERVER['HTTP_X_FORWARDED_FOR'];
      }
    }
    if (!empty($_SERVER['HTTP_X_FORWARDED']) && NetInfo::validate_ip($_SERVER['HTTP_X_FORWARDED']))
      return $_SERVER['HTTP_X_FORWARDED'];
    if (!empty($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']) && NetInfo::validate_ip($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']))
      return $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
    if (!empty($_SERVER['HTTP_FORWARDED_FOR']) && NetInfo::validate_ip($_SERVER['HTTP_FORWARDED_FOR']))
      return $_SERVER['HTTP_FORWARDED_FOR'];
    if (!empty($_SERVER['HTTP_FORWARDED']) && NetInfo::validate_ip($_SERVER['HTTP_FORWARDED']))
      return $_SERVER['HTTP_FORWARDED'];
    // return unreliable ip since all else failed
    return $_SERVER['REMOTE_ADDR'];
  }
  /**
   * Ensures an ip address is both a valid IP and does not fall within
   * a private network range.
   */
  public static function validate_ip($ip){
    if (strtolower($ip) === 'unknown')
      return false;
    // generate ipv4 network address
    $ip = ip2long($ip);
    // if the ip is set and not equivalent to 255.255.255.255
    if ($ip !== false && $ip !== -1){
      // make sure to get unsigned long representation of ip
      // due to discrepancies between 32 and 64 bit OSes and
      // signed numbers (ints default to signed in PHP)
      $ip = sprintf('%u', $ip);
      // do private network range checking
      if ($ip >= 0 && $ip <= 50331647) return false;
      if ($ip >= 167772160 && $ip <= 184549375) return false;
      if ($ip >= 2130706432 && $ip <= 2147483647) return false;
      if ($ip >= 2851995648 && $ip <= 2852061183) return false;
      if ($ip >= 2886729728 && $ip <= 2887778303) return false;
      if ($ip >= 3221225984 && $ip <= 3221226239) return false;
      if ($ip >= 3232235520 && $ip <= 3232301055) return false;
      if ($ip >= 4294967040) return false;
    }
    return true;
  }

  public static function browser(){
    if (strpos($_SERVER['HTTP_USER_AGENT'], 'Opera') || strpos($_SERVER['HTTP_USER_AGENT'], 'OPR/')) return 'Opera';
    elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Edge')) return 'Edge';
    elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome')) return 'Chrome';
    elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Safari')) return 'Safari';
    elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox')) return 'Firefox';
    elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') || strpos($_SERVER['HTTP_USER_AGENT'], 'Trident/7')) return 'Internet Explorer';
    return 'Other';
  }


  public static function platform(){
    if (strpos($_SERVER['HTTP_USER_AGENT'], 'Windows') || strpos($_SERVER['HTTP_USER_AGENT'], 'Win/')) return 'Windows';
    elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Linux')) return 'Linux';
    elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Mac')) return 'Mac OSX';
    elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Android')) return 'Android';
    return 'Other';
  }

  public static function system(){
    if (strpos($_SERVER['HTTP_USER_AGENT'], 'Win64') || strpos($_SERVER['HTTP_USER_AGENT'], 'WOW64')) return 'x64';
    elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'x64')) return 'x64';
    return 'Other';
  }

}
