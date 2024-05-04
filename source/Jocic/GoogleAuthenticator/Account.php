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
     * <i>Account</i> class is used for specifying various account-related
     * information required for <i>2FA</i> implementation.
     * 
     * @author    Djordje Jocic <office@djordjejocic.com>
     * @copyright 2024 All Rights Reserved
     * @version   1.0.0
     */
    class Account implements Interfaces\AccountInterface
    {
        /******************\
        |* CORE VARIABLES *|
        \******************/
        
        /**
         * Assigned account ID, ex. <i>1337</i>.
         * 
         * @var    integer|null
         * @access private
         */
        private int|null $accountId = null;
        
        /**
         * Reference of an account manager storing the account.
         * 
         * @var    object|null
         * @access private
         */
        private AccountManager|null $accountManager = null;
        
        /**
         * Name of the service used by an account, ex. <i>Hosting ABC</i>.
         * 
         * @var    string|null
         * @access private
         */
        private string|null $serviceName = null;
        
        /**
         * Name of an account, ex. <i>John Doe</i> or <i>john@doe.com</i>.
         * 
         * @var    string|null
         * @access private
         */
        private string|null $accountName = null;
        
        /**
         * Secret of an account.
         * 
         * @var    object|null
         * @access private
         */
        private Secret|null $accountSecret = null;
        
        /*******************\
        |* MAGIC FUNCTIONS *|
        \*******************/
        
        /**
         * Generic PHP constructor for the class <i>Account</i>.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2024 All Rights Reserved
         * @version   1.0.0
         * 
         * @param string|null $serviceName
         *   Account's service name that should be set.
         * @param string|null $accountName
         *   Account's name that should be set.
         * @param object|null $secret
         *   Account's secret that should be set.
         * @return void
         */
        public function __construct(
            string|null $serviceName = null,
            string|null $accountName = null,
            Secret|null $accountSecret = null)
        {
            // Logic
            
            if ($serviceName !== NULL)
            {
                $this->setServiceName($serviceName);
            }
            
            if ($accountName !== NULL)
            {
                $this->setAccountName($accountName);
            }
            
            if ($accountSecret !== NULL)
            {
                $this->setAccountSecret($accountSecret);
            }
        }
        
        /***************\
        |* GET METHODS *|
        \***************/
        
        /**
         * Returns an account's ID.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2024 All Rights Reserved
         * @version   1.0.0
         * 
         * @return integer|null
         *   ID of an account ex. <i>123</i>, or value <i>NULL</i>
         *   if the ID wasn't set for the account.
         */
        public function getAccountId() : int|null
        {
            // Logic
            
            return $this->accountId;
        }
        
        /**
         * Returns an account's manager.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2024 All Rights Reserved
         * @version   1.0.0
         * 
         * @return object|null
         *   Reference to the account's manager, or value
         *   <i>NULL</i> if the account's manager wasn't set.
         */
        public function getAccountManager() : AccountManager|null
        {
            // Logic
            
            return $this->accountManager;
        }
        
        /**
         * Returns an account's service name.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2024 All Rights Reserved
         * @version   1.0.0
         * 
         * @return string|null
         *   Name of an account's service, ex. <i>Hosting ABC</i>, or value
         *   <i>NULL</i> if the account's service name wasn't set.
         */
        public function getServiceName() : string|null
        {
            // Logic
            
            return $this->serviceName;
        }
        
        /**
         * Returns an account's name.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2024 All Rights Reserved
         * @version   1.0.0
         * 
         * @return string|null
         *   Name of an account, ex. <i>John Doe</i> or <i>john@doe.com</i>,
         *   or value <i>NULL</i> if the account's name wasn't set.
         */
        public function getAccountName() : string|null
        {
            // Logic
            
            return $this->accountName;
        }
        
        /**
         * Returns an account's secret.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2024 All Rights Reserved
         * @version   1.0.0
         * 
         * @return object|null
         *   Secret of an account, or value <i>NULL</i> if the account's
         *   secret wasn't set.
         */
        public function getAccountSecret() : Secret|null
        {
            // Logic
            
            return $this->accountSecret;
        }
        
        /***************\
        |* SET METHODS *|
        \***************/
        
        /**
         * Sets an account's ID.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2024 All Rights Reserved
         * @version   1.0.0
         * 
         * @param integer $accountId
         *   New account's ID.
         * @return object
         *   Reference to the object calling the method - current object.
         */
        public function setAccountId($accountId) : self
        {
            // Logic
            
            if ($this->accountId != null)
            {
                throw new \Exception("ID was already assigned.");
            }
            
            $this->accountId = $accountId;
            
            return $this;
        }
        
        /**
         * Sets an account's manager.
         * 
         * <strong>Note:</strong> This method is called by the
         * <i>AccountManager</i> object once the account is associated with
         * it through one of the <i>set</i> or <i>add</i> methods.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2024 All Rights Reserved
         * @version   1.0.0
         * 
         * @param object $accountManager
         *   New account's manager.
         * @return object
         *   Reference to the object calling the method - current object.
         */
        public function setAccountManager($accountManager) : self
        {
            // Logic
            
            if (!($accountManager instanceof AccountManager))
            {
                throw new \Exception("Invalid object used.");
            }
            
            $this->accountManager = $accountManager;
            
            return $this;
        }
        
        /**
         * Sets an account's service name.
         * 
         * Note: Service name parameter is required, it must be set.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2024 All Rights Reserved
         * @version   1.0.0
         * 
         * @param string $serviceName
         *   New account's service name.
         * @return object
         *   Reference to the object calling the method - current object.
         */
        public function setServiceName($serviceName) : self
        {
            // Logic
            
            $this->serviceName = $serviceName;
            
            return $this;
        }
        
        /**
         * Sets an account's name.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2024 All Rights Reserved
         * @version   1.0.0
         * 
         * @param string $accountName
         *   New account's name.
         * @return object
         *   Reference to the object calling the method - current object.
         */
        public function setAccountName($accountName) : self
        {
            // Logic
            
            $this->accountName = $accountName;
            
            return $this;
        }
        
        /**
         * Sets an account's secret.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2024 All Rights Reserved
         * @version   1.0.0
         * 
         * @param mixed $accountSecret
         *   New account's secret.
         * @return object
         *   Reference to the object calling the method - current object.
         */
        public function setAccountSecret($accountSecret) : self
        {
            // Logic
            
            if (is_string($accountSecret))
            {
                $accountSecret = new Secret($accountSecret);
            }
            
            $this->accountSecret = $accountSecret;
            
            return $this;
        }
    }
    
?>
