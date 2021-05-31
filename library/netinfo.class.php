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

  public $userAgent;

  function __construct($userAgent) {
    $this->userAgent = $userAgent;
  }

  //ASSIGN VARIABLES TO USER INFO
  /**
   * Retrieves the best guess of the client's actual IP address.
   * Takes into account numerous HTTP proxy headers due to variations
   * in how different ISPs handle IP addresses in headers between hops.
   */
  function ip(){
    // check for shared internet/ISP IP
    if (!empty($_SERVER['HTTP_CLIENT_IP']) && validate_ip($_SERVER['HTTP_CLIENT_IP'])) {
      return $_SERVER['HTTP_CLIENT_IP'];
    }
    // check for IPs passing through proxies
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
      // check if multiple ips exist in var
      if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',') !== false) {
        $iplist = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        foreach ($iplist as $ip) {
          if (validate_ip($ip))
            return $ip;
        }
      } else {
        if (validate_ip($_SERVER['HTTP_X_FORWARDED_FOR']))
          return $_SERVER['HTTP_X_FORWARDED_FOR'];
      }
    }
    if (!empty($_SERVER['HTTP_X_FORWARDED']) && validate_ip($_SERVER['HTTP_X_FORWARDED']))
      return $_SERVER['HTTP_X_FORWARDED'];
    if (!empty($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']) && validate_ip($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']))
      return $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
    if (!empty($_SERVER['HTTP_FORWARDED_FOR']) && validate_ip($_SERVER['HTTP_FORWARDED_FOR']))
      return $_SERVER['HTTP_FORWARDED_FOR'];
    if (!empty($_SERVER['HTTP_FORWARDED']) && validate_ip($_SERVER['HTTP_FORWARDED']))
      return $_SERVER['HTTP_FORWARDED'];
    // return unreliable ip since all else failed
    return $_SERVER['REMOTE_ADDR'];
  }
  /**
   * Ensures an ip address is both a valid IP and does not fall within
   * a private network range.
   */
  function validate_ip($ip){
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

  function browser(){
    if (strpos($this->userAgent, 'Opera') || strpos($this->userAgent, 'OPR/')) return 'Opera';
    elseif (strpos($this->userAgent, 'Edge')) return 'Edge';
    elseif (strpos($this->userAgent, 'Chrome')) return 'Chrome';
    elseif (strpos($this->userAgent, 'Safari')) return 'Safari';
    elseif (strpos($this->userAgent, 'Firefox')) return 'Firefox';
    elseif (strpos($this->userAgent, 'MSIE') || strpos($this->userAgent, 'Trident/7')) return 'Internet Explorer';
    return 'Other';
  }


  function platform(){
    if (strpos($this->userAgent, 'Windows') || strpos($this->userAgent, 'Win/')) return 'Windows';
    elseif (strpos($this->userAgent, 'Linux')) return 'Linux';
    elseif (strpos($this->userAgent, 'Mac')) return 'Mac OSX';
    elseif (strpos($this->userAgent, 'Android')) return 'Android';
    return 'Other';
  }

  function system(){
    if (strpos($this->userAgent, 'Win64') || strpos($this->userAgent, 'WOW64')) return 'x64';
    elseif (strpos($this->userAgent, 'x64')) return 'x64';
    return 'Other';
  }

}
