<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * GoogleAnalytics plugin class
 *
 * @package GoogleAnalytics
 */
class MultiLanguagePlugin extends Omeka_Plugin_AbstractPlugin
{
    protected $_hooks = array(
        'install',
        'uninstall'
    );

    protected $_filters = array(
        'locale',
    );

    protected $locale_code;

    public function hookInstall()
    {
        //set_option('google_analytics_key', '');
    }

    public function hookUninstall()
    {
        //delete_option('google_analytics_key');
    }

    public function filterLocale($locale)
    {
      //check default (from config)
      $defaultCodes = Zend_Locale::getDefault();
      $this->locale_code = current(array_keys($defaultCodes));

      //check session
      $langNamespace = new Zend_Session_Namespace('lang');
      if (isset($langNamespace->lang)):
        $this->locale_code = $langNamespace->lang;
      endif;

      //check url
      if(isset($_GET['lang'])):
        $lang = $_GET['lang'];
      else:
          return $this->locale_code;
      endif;

      if ($lang == "nl"):
          $this->locale_code = "nl_BE";
          $langNamespace->lang = "nl_BE";
      elseif($lang == "fr"):
          $this->locale_code = "fr";
          $langNamespace->lang = "fr";
      endif;

      return $this->locale_code;
    }    
}
