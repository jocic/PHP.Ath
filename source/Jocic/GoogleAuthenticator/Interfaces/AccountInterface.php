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
    
    namespace Jocic\GoogleAuthenticator\Interfaces;
    
    use Jocic\GoogleAuthenticator\Secret;
    
    /**
     * <i>AccountInterface</i> is an interface used to enforce implementation
     * of core methods of the class <i>Account</i>.
     * 
     * @author    Djordje Jocic <office@djordjejocic.com>
     * @copyright 2024 All Rights Reserved
     * @version   1.0.0
     */
    interface AccountInterface
    {
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
        public function getAccountId() : int|null;
        
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
        public function getServiceName() : string|null;
        
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
        public function getAccountName() : string|null;
        
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
        public function getAccountSecret() : Secret|null;
        
        /***************\
        |* SET METHODS *|
        \***************/
        
        /**
         * Sets an account's ID, ex. <i>1337</i>.
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
        public function setAccountId(int $accountId) : self;
        
        /**
         * Sets an account's service name, ex. <i>FastFood ABC</i>.
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
        public function setServiceName(string $serviceName) : self;
        
        /**
         * Sets an account's name, ex. <i>John Doe</i>.
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
        public function setAccountName(string $accountName) : self;
        
        /**
         * Sets an account's secret.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2024 All Rights Reserved
         * @version   1.0.0
         * 
         * @param object $accountSecret
         *   New account's secret.
         * @return object
         *   Reference to the object calling the method - current object.
         */
        public function setAccountSecret(Secret $accountSecret) : self;
    }
    
?>
