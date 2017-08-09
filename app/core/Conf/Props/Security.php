<?php
namespace Core\Conf\Props;

/**
 * @author Chris K. Hu <chris@microlemur.com>
 */
class Security {
    public $CSRFExpire;
    public $CSRFTokenName;
    public $CSRFCookieName;
    public $CSRFRegenerate;
    public $cookiePrefix;
    public $cookiePath;
    public $cookieDomain;
    public $cookieSecure;

    public function __construct($data)
    {
        $this->CSRFExpire     =  $data->CSRFExpire     ?? null  ;
        $this->CSRFTokenName  =  $data->CSRFTokenName  ?? null  ;
        $this->CSRFCookieName =  $data->CSRFCookieName ?? null  ;
        $this->CSRFRegenerate =  $data->CSRFRegenerate ?? false ;
        $this->cookiePrefix   =  $data->cookiePrefix   ?? null  ;
        $this->cookiePath     =  $data->cookiePath     ?? null  ;
        $this->cookieDomain   =  $data->cookieDomain   ?? null  ;
        $this->cookieSecure   =  $data->cookieSecure   ?? null  ;
    }
}
