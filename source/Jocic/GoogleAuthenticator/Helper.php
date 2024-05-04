<?php
    
    /*******************************************************************\
    |* Author: Djordje Jocic                                           *|
    |* Year: 2024                                                      *|
    |* License: MIT License (MIT)                                      *|
    |* =============================================================== *|
    |* Personal Website: http://www.djordjejocic.com/                  *|
    |* =============================================================== *|
    |* Permission is hereby granted, free of charge, to any person     *|
    |* obtaining a copy of this software and associated documentation  *|
    |* files (the "Software"), to deal in the Software without         *|
    |* restriction, including without limitation the rights to use,    *|
    |* copy, modify, merge, publish, distribute, sublicense, and/or    *|
    |* sell copies of the Software, and to permit persons to whom the  *|
    |* Software is furnished to do so, subject to the following        *|
    |* conditions.                                                     *|
    |* --------------------------------------------------------------- *|
    |* The above copyright notice and this permission notice shall be  *|
    |* included in all copies or substantial portions of the Software. *|
    |* --------------------------------------------------------------- *|
    |* THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, *|
    |* EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES *|
    |* OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND        *|
    |* NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT     *|
    |* HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,    *|
    |* WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, RISING     *|
    |* FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR   *|
    |* OTHER DEALINGS IN THE SOFTWARE.                                 *|
    \*******************************************************************/
    
    namespace Jocic\GoogleAuthenticator;
    
    /**
     * <i>Helper</i> is a class containing various generic methods used
     * throughout the library.
     * 
     * @author    Djordje Jocic <office@djordjejocic.com>
     * @copyright 2024 All Rights Reserved
     * @version   1.0.0
     */
    class Helper
    {
        /******************\
        |* CORE VARIABLES *|
        \******************/
        
        /**
         * Instance of the Singleton class.
         * 
         * @var    object
         * @access private
         */
        private static $instance = null;
        
        /*******************\
        |* MAGIC FUNCTIONS *|
        \*******************/
        
        /**
         * Generic private constructor for a Singleton.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2024 All Rights Reserved
         * @version   1.0.0
         * 
         * @return void
         */
        protected function __construct() {}
        
        /**
         * Generic clone function for a Singleton.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2024 All Rights Reserved
         * @version   1.0.0
         * 
         * @return void
         */
        protected function __clone() {}
        
        /**
         * Generic wakeup function for a Singleton.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2024 All Rights Reserved
         * @version   1.0.0
         * 
         * @return void
         */
        public function __wakeup() {}
        
        /***************\
        |* GET METHODS *|
        \***************/
        
        /**
         * Generic getter method for the Singleton's instance.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2024 All Rights Reserved
         * @version   1.0.0
         * 
         * @return object
         *   Reference to the one and only Singleton's instance.
         */
        public static function getInstance()
        {
            // Logic
            
            if (static::$instance == null)
            {
                static::$instance = new static;
            }
            
            return static::$instance;
        }
        
        /****************\
        |* CORE METHODS *|
        \****************/
        
        /**
         * Returns value of a set secret from the provided entity ex. Account.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2024 All Rights Reserved
         * @version   1.0.0
         * 
         * @param object $entity
         *   Entity that should be used in the process.
         * @return string
         *   Value of the set secret.
         */
        public function fetchSecret($entity)
        {
            // Logic
            
            if ($entity instanceof Account)
            {
                return $this->fetchSecret__ACCOUNT($entity);
            }
            
            if ($entity instanceof Secret)
            {
                return $this->fetchSecret__SECRET($entity);
            }
            
            return NULL;
        }
        
        /*****************\
        |* OTHER METHODS *|
        \*****************/
        
        
        /**
         * Returns value of a set secret for the provided Account.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2024 All Rights Reserved
         * @version   1.0.0
         * 
         * @param object $account
         *   Account that should be used in the process.
         * @return string
         *   Value of the set secret.
         */
        private function fetchSecret__ACCOUNT($account)
        {
            if ($account->getAccountSecret() == null)
            {
                return '';
            }
            
            return $account->getAccountSecret()->getValue();
        }
        
        
        /**
         * Returns value of the provided Secret.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2024 All Rights Reserved
         * @version   1.0.0
         * 
         * @param object $secret
         *   Secret that should be used in the process.
         * @return string
         *   Value of the set secret.
         */
        private function fetchSecret__SECRET($secret)
        {
            return $secret->getValue();
        }
    }
    
?>
