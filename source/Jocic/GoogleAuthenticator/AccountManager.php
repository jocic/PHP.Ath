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
    
    use Jocic\GoogleAuthenticator\FileSystem;
    
    /**
     * <i>AccountManager</i> class is used for long-term storage and
     * account management in your application. It provides basic methods
     * to get you started, and is meant to be extended.
     * 
     * @author    Djordje Jocic <office@djordjejocic.com>
     * @copyright 2024 All Rights Reserved
     * @version   1.0.0
     */
    class AccountManager implements Interfaces\AccountManagerInterface
    {
        /******************\
        |* CORE VARIABLES *|
        \******************/
        
        /**
         * Array containing manager's accounts.
         * 
         * @var    array
         * @access protected
         */
        protected array $accounts = [];
        
        /**
         * Integer containing last used ID.
         * 
         * @var    integer|null
         * @access protected
         */
        protected int|null $lastId = null;
        
        /***************\
        |* GET METHODS *|
        \***************/
        
        /**
         * Returns an array containing added accounts.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2024 All Rights Reserved
         * @version   1.0.0
         * 
         * @return array
         *   Array containing all added accounts.
         */
        public function getAccounts() : array
        {
            // Logic
            
            return $this->accounts;
        }
        
        /**
         * Returns the last assigned account ID.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2024 All Rights Reserved
         * @version   1.0.0
         * 
         * @return integer|null
         *   Last assigned account ID, or value <i>NULL</i> if
         *   no IDs were assigned by the manager.
         */
        public function getLastId() : int|null
        {
            // Logic
            
            return $this->lastId;
        }
        
        /**
         * Returns the next available account ID.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2024 All Rights Reserved
         * @version   1.0.0
         * 
         * @return integer
         *   Next available account ID.
         */
        public function getNextId() : int
        {
            // Logic
            
            return $this->lastId + 1;
        }
        
        /***************\
        |* SET METHODS *|
        \***************/
        
       /**
         * Replaces manager's accounts with new ones.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2024 All Rights Reserved
         * @version   1.0.0
         * 
         * @param array $accounts
         *   Array containing new accounts that should be assigned.
         * @return object
         *   Reference to the object calling the method - current object.
         */
        public function setAccounts(array $accounts) : self
        {
            // Step 1 - Reset Manager
            
            $this->reset();
            
            // Step 2 - Process Accounts
            
            foreach ($accounts as $account)
            {
                if (!($account instanceof Account))
                {
                    throw new \Exception("Invalid object type.");
                }
                
                $this->addAccount($account);
            }
            
            return $this;
        }
        
        /****************\
        |* CORE METHODS *|
        \****************/
        
        public function incrementId() : void
        {
            // Logic
            
            $this->lastId++;
        }
        
        /**
         * Adds an account to the manager.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2024 All Rights Reserved
         * @version   1.0.0
         * 
         * @param object $account
         *   Account that should be added.
         * @return object
         *   Reference to the object calling the method - current object.
         */
        public function addAccount(Account $account) : self
        {
            // Step 1 - Handle Account ID
            
            if ($account->getAccountId() == null)
            {
                $account->setAccountId($this->getNextId());
            }
            
            $this->incrementId();
            
            // Step 2 - Add Account
            
            $this->accounts[] = $account;
            
            $account->setAccountManager($this);
            
            return $this;
        }
        
        /******************\
        |* REMOVE METHODS *|
        \******************/
        
        /**
         * Removes an account from the manager.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2024 All Rights Reserved
         * @version   1.0.0
         * 
         * @param mixed $account
         *   Identifier of an account, or an account object, that should be
         *   removed from the manager - ID, Name, Object, etc.
         * @return bool
         *   Value <i>TRUE</i> if an account was removed, and vice versa.
         */
        public function removeAccount(mixed $account) : bool
        {
            // Logic
            
            if (is_numeric($account))
            {
                return $this->removeAccount__ID($account);
            }
            else if (is_string($account))
            {
                return $this->removeAccount__NAME($account);
            }
            else if ($account instanceof Account)
            {
                return $this->removeAccount__OBJECT($account);
            }
            
            throw new \Exception("Option couldn't be determined.");
            
            return false;
        }
        
        /**
         * Removes an account from the manager using the account's ID.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2024 All Rights Reserved
         * @version   1.0.0
         * 
         * @param integer $accountId
         *   ID of an account that should be removed.
         * @return bool
         *   Value <i>TRUE</i> if an account was removed, and vice versa.
         */
        protected function removeAccount__ID(
            int $accountId) : bool
        {
            // Core Variables
            
            $accounts = $this->getAccounts();
            
            // Step 1 - Check Value
            
            if (!is_numeric($accountId))
            {
                throw new \Exception("Provided ID isn't numeric.");
            }
            
            // Step 2 - Remove Account
            
            foreach ($accounts as $accountKey => $accountObject)
            {
                if ($accountObject->getAccountId() == $accountId)
                {
                    unset($accounts[$accountKey]);
                    
                    $this->accounts = $accounts;
                    
                    return true;
                }
            }
            
            return false;
        }
        
        /**
         * Removes an account from the manager using the account's name.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2024 All Rights Reserved
         * @version   1.0.0
         * 
         * @param string $accountName
         *   Name of an account that should be removed.
         * @return bool
         *   Value <i>TRUE</i> if an account was removed, and vice versa.
         */
        protected function removeAccount__NAME(
            string $accountName) : bool
        {
            // Core Variables
            
            $accounts = $this->getAccounts();
            
            // Step 1 - Check Value
            
            if (!is_string($accountName))
            {
                throw new \Exception("Provided ID isn't string.");
            }
            
            // Step 2 - Remove Account
            
            foreach ($accounts as $accountKey => $accountObject)
            {
                if ($accountObject->getAccountName() == $accountName)
                {
                    unset($accounts[$accountKey]);
                    
                    $this->accounts = $accounts;
                    
                    return true;
                }
            }
            
            return false;
        }
        
        /**
         * Removes an account from the manager using the account's object.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2024 All Rights Reserved
         * @version   1.0.0
         * 
         * @param object $accountObject
         *   Object of an account that should be removed.
         * @return bool
         *   Value <i>TRUE</i> if an account was removed, and vice versa.
         */
        protected function removeAccount__OBJECT(
            Account $accountObject) : bool
        {
            // Core Variables
            
            $identifier = null;
            
            // Logic
            
            if (($identifier = $accountObject->getAccountId()) != null)
            {
                return $this->removeAccount__ID($identifier);
            }
            else if (($identifier = $accountObject->getAccountName()) != null)
            {
                return $this->removeAccount__NAME($identifier);
            }
            
            return false;
        }
        
        /****************\
        |* FIND METHODS *|
        \****************/
        
        /**
         * Finds an account associated with the manager.
         * 
         * <strong>Note:</strong> Depending on your implementation, you can
         * use an Account object containing partial information about the
         * account you are searching for ie. just the name, etc.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2024 All Rights Reserved
         * @version   1.0.0
         * 
         * @param mixed $account
         *   Identifier of an account, or an account object, that should be
         *   removed from the manager - ID, Name, Object, etc.
         * @return object|null
         *   Account object that was found, or value <i>NULL</i> if it wasn't.
         */
        public function findAccount(mixed $account) : Account|null
        {
            // Logic
            
            if (is_numeric($account))
            {
                return $this->findAccount__ID($account);
            }
            else if (is_string($account))
            {
                return $this->findAccount__NAME($account);
            }
            else if ($account instanceof Account)
            {
                return $this->findAccount__OBJECT($account);
            }
            
            throw new \Exception("Option couldn't be determined.");
            
            return null;
        }
        
        /**
         * Finds and returns an account from the manager using
         * the account's ID.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2024 All Rights Reserved
         * @version   1.0.0
         * 
         * @param integer $accountId
         *   ID of an account that should be found.
         * @return object|null
         *   Account object that was found, or value <i>NULL</i> if it wasn't.
         */
        protected function findAccount__ID(
            int $accountId) : object|null
        {
            // Core Variables
            
            $accounts = $this->getAccounts();
            
            // Step 1 - Check Value
            
            if (!is_numeric($accountId))
            {
                throw new \Exception("Provided ID isn't numeric.");
            }
            
            // Step 2 - Remove Account
            
            foreach ($accounts as $accountObject)
            {
                if ($accountObject->getAccountId() == $accountId)
                {
                    return $accountObject;
                }
            }
            
            return null;
        }
        
        /**
         * Finds and returns an account from the manager using
         * the account's name.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2024 All Rights Reserved
         * @version   1.0.0
         * 
         * @param string $accountName
         *   Name of an account that should be found.
         * @return object|null
         *   Account object that was found, or value <i>NULL</i> if it wasn't.
         */
        protected function findAccount__NAME(
            string $accountName) : object|null
        {
            // Core Variables
            
            $accounts = $this->getAccounts();
            
            // Step 1 - Check Value
            
            if (!is_string($accountName))
            {
                throw new \Exception("Provided ID isn't string.");
            }
            
            // Step 2 - Find Account
            
            foreach ($accounts as $accountObject)
            {
                if ($accountObject->getAccountName() == $accountName)
                {
                    return $accountObject;
                }
            }
            
            return null;
        }
        
        /**
         * Finds and returns an account from the manager using
         * the account's object.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2024 All Rights Reserved
         * @version   1.0.0
         * 
         * @param object $accountObject
         *   Object of an account that should be found.
         * @return object|null
         *   Account object that was found, or value <i>NULL</i> if it wasn't.
         */
        protected function findAccount__OBJECT(
            Account $accountObject) : object|null
        {
            // Core Variables
            
            $identifier = null;
            
            // Logic
            
            if (($identifier = $accountObject->getAccountId()) != null)
            {
                return $this->findAccount__ID($identifier);
            }
            else if (($identifier = $accountObject->getAccountName()) != null)
            {
                return $this->findAccount__NAME($identifier);
            }
            
            return null;
        }
        
        /**
         * Saves manager's accounts to a file.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2024 All Rights Reserved
         * @version   1.0.0
         * 
         * @param string $fileLocation
         *   File location that should be used for saving.
         * @return bool
         *   Value <i>TRUE</i> if accounts were saved, and vice versa.
         */
        public function save($fileLocation) : bool
        {
            // Core Variables
            
            $accounts = $this->getAccounts();
            $data     = [];
            
            // IO Variables
            
            $fileSystem = new FileSystem();
            
            // Step 1 - Serialize Data
            
            foreach ($accounts as $account)
            {
                $data[] = [
                    "version"      => "1",
                    "account_id"   => $account->getAccountId(),
                    "service_name" => $account->getServiceName(),
                    "account_name" => $account->getAccountName(),
                    "secret"       => $account->getAccountSecret()
                ];
            }
            
            $data = serialize($data);
            
            // Step 2 - Save Data
            
            try
            {
                return $fileSystem->save($fileLocation, $data, true);
            }
            catch (\Exception $e)
            {
                return false;
            }
        }
        
        /**
         * Loads manager's accounts from a file.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2024 All Rights Reserved
         * @version   1.0.0
         * 
         * @param string $fileLocation
         *   File location that should be used for loading.
         * @param integer $bufferSize
         *   Buffer size in bytes that will be used for loading.
         * @return bool
         *   Value <i>TRUE</i> if accounts were loaded, and vice versa.
         */
        public function load($fileLocation, $bufferSize = 1024) : bool
        {
            // Core Variables
            
            $accounts = null;
            $account  = null;
            
            // IO Variables
            
            $fileSystem   = new FileSystem();
            $fileContents = null;
            
            // Step 1 - Load Accounts
            
            try
            {
                $fileContents = $fileSystem->load(
                    $fileLocation, $bufferSize, true);
                
                if ($fileContents !== null)
                {
                    $accounts = unserialize($fileContents);
                }
            }
            catch (\Exception $e)
            {
                return false;
            }
            
            // Step 2 - Process Accounts
            
            if (is_array($accounts))
            {
                $this->reset();
                
                foreach ($accounts as $account)
                {
                    // Only Add Valid Data
                    
                    if (    isset($account["account_id"])
                         && isset($account["service_name"])
                         && isset($account["account_name"])
                         && isset($account["secret"]))
                    {
                        $loadedAccount = new Account();
                        
                        $loadedAccount->setAccountId($account["account_id"]);
                        $loadedAccount->setServiceName($account["service_name"]);
                        $loadedAccount->setAccountName($account["account_name"]);
                        $loadedAccount->setAccountSecret($account["secret"]);
                        
                        $this->addAccount($loadedAccount);
                    }
                }
                
                return true;
            }
            
            return false;
        }
        
        /*****************\
        |* OTHER METHODS *|
        \*****************/
        
        /**
         * Resets account manager, essentially removing all added accounts.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2024 All Rights Reserved
         * @version   1.0.0
         * 
         * @return object
         *   Reference to the object calling the method - current object.
         */
        public function reset() : self
        {
            // Logic
            
            $this->accounts = [];
            $this->lastId   = 0;
            
            return $this;
        }
    }
    
?>
