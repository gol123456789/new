<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category   Varien
 * @package    Varien_Autoload
 * @copyright  Copyright (c) 2008 Irubin Consulting Inc. DBA Varien (http://www.varien.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Classes source autoload
 */

class Varien_Autoload
{
    const SCOPE_FILE_PREFIX = '__';

    static protected $_instanceHelper;
    static protected $_instance;
    static protected $_scope = 'default';

    protected $_isIncludePathDefined= null;
    protected $_collectClasses      = true;
    protected $_collectPath         = '/home/gerard/sites/mageclean/var/path';
    protected $_arrLoadedClasses    = array();
   

    /**
     * Class constructor
     */
    public function __construct()
    {
        $this->_isIncludePathDefined = defined('COMPILER_INCLUDE_PATH');
        if (defined('COMPILER_COLLECT_PATH')) {
            $this->_collectClasses  = true;
            $this->_collectPath     = COMPILER_COLLECT_PATH;
        }
        self::registerScope(self::$_scope);
    }

    /**
     * Singleton pattern implementation
     *
     * @return Varien_Autoload
     */
    static public function instance()
    {
      
//        include_once 'My/Mod/Helper/Data.php';
      //  include_once 'My/Mod/Helper/Includes.php';
   //    My_Mod_Helper_Data::register('Includes');
        if (!self::$_instance) {
            self::$_instance = new Varien_Autoload();
     //       self::$_instanceHelper = My_Mod_Helper_Data::register('Includes');
        }
        return self::$_instance;
    }

    /**
     * Register SPL autoload function
     */
    static public function register()
    {
        spl_autoload_register(array(self::instance(), 'autoload'));
    }

    /**
     * Load class source code
     *
     * @param string $class
     */
    public function autoload($class)
    {
        if ($this->_collectClasses) {
            $this->_arrLoadedClasses[self::$_scope][] = $class;
        }
        if ($this->_isIncludePathDefined) {
            $classFile =  COMPILER_INCLUDE_PATH . DIRECTORY_SEPARATOR . $class;
        } else {
            $classFile = str_replace(' ', DIRECTORY_SEPARATOR, ucwords(str_replace('_', ' ', $class)));
        }
        $classFile.= '.php';
        $helper = 'My_Mod_Helper_Data.php';
         if ($this->_isIncludePathDefined) {
            $helperFile =  COMPILER_INCLUDE_PATH . DIRECTORY_SEPARATOR . $helper;
        } else {
            $helperFile = str_replace(' ', DIRECTORY_SEPARATOR, ucwords(str_replace('_', ' ', $helper)));
        }
//      self::$_instanceHelper->log($classFile);
//        var_dump($logger); exit();
        //echo $classFile;die();
        return include $classFile;
    }

    /**
     * Register autoload scope
     * This process allow include scope file which can contain classes
     * definition which are used for this scope
     *
     * @param string $code scope code
     */
    static public function registerScope($code)
    {
        self::$_scope = $code;
        if (defined('COMPILER_INCLUDE_PATH')) {
            @include COMPILER_INCLUDE_PATH . DIRECTORY_SEPARATOR . self::SCOPE_FILE_PREFIX.$code.'.php';
        }
    }

    /**
     * Get current autoload scope
     *
     * @return string
     */
    static public function getScope()
    {
        return self::$_scope;
    }

    /**
     * Class destructor
     */
    public function __destruct()
    {
        if ($this->_collectClasses) {
            $this->_saveCollectedStat();
        }
    }

    /**
     * Save information about used classes per scope with class popularity
     * Class_Name:popularity
     *
     * @return Varien_Autoload
     */
    protected function _saveCollectedStat()
    {
        if (!is_dir($this->_collectPath)) {
         $made =   mkdir($this->_collectPath, 0777, true);
         $err = error_get_last();
          //  @chmod($this->_collectPath, 0777);
          $made =   mkdir('/home/gerard/blas', 0777, true);
         $err = error_get_last();
           
        }

        if (!is_writeable($this->_collectPath)) {
            return $this;
        }
       
        foreach ($this->_arrLoadedClasses as $scope => $classes) {
            $file = $this->_collectPath.DIRECTORY_SEPARATOR.$scope.'.csv';
            $data = array();
            if (file_exists($file)) {
                $data = explode("\n", file_get_contents($file));
                foreach ($data as $index => $class) {
                    $class = explode(':', $class);
                    $searchIndex = array_search($class[0], $classes);
                    if ($searchIndex !== false) {
                        $class[1]+=1;
                        unset($classes[$searchIndex]);
                    }
                    $data[$index] = $class[0].':'.$class[1];
                }
            }
            foreach ($classes as $class) {
                $data[] = $class . ':1';
            }
            $stop = implode('\n', $data);
            file_put_contents($file, implode("\n", $data));
        }
        
        return $this;
    }
    public function getClassArr(){
        return $this->_arrLoadedClasses;
    }
}
