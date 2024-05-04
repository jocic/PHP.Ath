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
    
    use PHPUnit\Framework\TestCase;
    use Jocic\GoogleAuthenticator\Secret as MfaSecret;
    use Jocic\GoogleAuthenticator\Account as MfaAccount;
    use Jocic\GoogleAuthenticator\AccountManager as MfaAccountManager;
    
    /**
     * <i>TestAccountManager</i> class is used for testing method implementation
     * of the class <i>AccountManager</i>.
     * 
     * @author    Djordje Jocic <office@djordjejocic.com>
     * @copyright 2024 All Rights Reserved
     * @version   1.0.0
     */
    class Manager extends TestCase
    {
        /*********************\
        |* GET & SET METHODS *|
        \*********************/
        
        /**
         * Tests <i>setAccounts</i> & <i>getAccounts</i> methods.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2024 All Rights Reserved
         * @version   1.0.0
         * 
         * @return void
         */
        public function testAccountsMethods()
        {
            // Core Variables
            
            $accountManager = new MfaAccountManager();
            
            // Other Variables
            
            $setAccounts  = null;
            $testAccounts = [
                new MfaAccount("A", "B", new MfaSecret()),
                new MfaAccount("C", "D", new MfaSecret()),
                new MfaAccount("E", "F", new MfaSecret())
            ];
            
            // Step 2 - Test Valid Setting
            
            $accountManager->setAccounts($testAccounts);
            
            $setAccounts = $accountManager->getAccounts();
            
            $this->assertSame(3, count($setAccounts),
                "Not all accounts were set.");
            
            for ($i = 0; $i < count($testAccounts); $i ++)
            {
                $this->assertSame($setAccounts[$i]->getAccountSecret(),
                    $testAccounts[$i]->getAccountSecret(),
                    "Invalid secret found.");
            }
            
            // Step 2 - Test Invalid Setting - Object
            
            try
            {
                $accountManager->setAccounts([
                    new MfaSecret()
                ]);
                
                $this->fail("Exception should've been thrown!");
            }
            catch (\Exception $e)
            {
                $this->assertEquals("Invalid object type.", $e->getMessage());
            }
        }
        
        /*******************\
        |* PRIMARY METHODS *|
        \*******************/
        
        /**
         * Tests <i>addAccount</i> method of the <i>AccountManager</i> class.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2024 All Rights Reserved
         * @version   1.0.0
         * 
         * @return void
         */
        public function testAddAccountMethod()
        {
            // Core Variables
            
            $accountManager = null;
            $account        = null;
            
            // Other Variables
            
            $testAccounts = [
                new MfaAccount("A", "B", new MfaSecret()),
                new MfaAccount("C", "D", new MfaSecret()),
                new MfaAccount("E", "F", new MfaSecret())
            ];
            
            // Step 1 - Test Adding Accounts
            
            $accountManager = new MfaAccountManager();
            
            foreach ($testAccounts as $testAccount)
            {
                // Add Account
                
                $accountManager->addAccount($testAccount);
                
                // Check If Added
                
                $account = $accountManager->findAccount($testAccount);
                
                $this->assertSame($account->getAccountSecret(),
                    $testAccount->getAccountSecret(), "Invalid secret found.");
            }
            
            $this->assertSame(3, $accountManager->getLastId(),
                "Invalid last ID after generated account ID.");
            
            $this->assertSame(4, $accountManager->getNextId(),
                "Invalid next ID after generated account ID.");
            
            // Step 2 - Test Adding Account With ID
            
            $account = new MfaAccount("X", "X", new MfaSecret());
            
            $account->setAccountId(1337);
            
            $accountManager->addAccount($account);
            
            $this->assertSame(4, $accountManager->getLastId(),
                "Invalid last ID after pre-set account ID.");
            
            $this->assertSame(5, $accountManager->getNextId(),
                "Invalid next ID after pre-set account ID");
        }
        
        /**
         * Tests <i>removeAccount</i> method of the <i>AccountManager</i> class.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2024 All Rights Reserved
         * @version   1.0.0
         * 
         * @return void
         */
        public function testRemoveAccountMethod()
        {
            // Core Variables
            
            $accountManager = new MfaAccountManager();
            
            // Other Variables
            
            $testAccounts = [
                new MfaAccount("A", "B", new MfaSecret()),
                new MfaAccount("C", "D", new MfaSecret()),
                new MfaAccount("E", "F", new MfaSecret()),
                new MfaAccount("G", "H", new MfaSecret()),
                new MfaAccount("I", "J", new MfaSecret())
            ];
            
            // Step 1 - Set Accounts
            
            $accountManager->setAccounts($testAccounts);
            
            // Step 2 - Test Removal By ID
            
            $this->assertTrue($accountManager->removeAccount(1),
                "Removal by \"ID\" failed - existing.");
            
            $this->assertFalse($accountManager->removeAccount(1),
                "Removal by \"ID\" failed - non-existing.");
            
            // Step 3 - Test Removal By Name
            
            $this->assertTrue($accountManager->removeAccount("D"),
                "Removal by \"Name\" failed - existing.");
            
            $this->assertFalse($accountManager->removeAccount("D"),
                "Removal by \"Name\" failed - non-existing.");
            
            // Step 4 - Test Removal By Object
            
            $this->assertTrue($accountManager->removeAccount($testAccounts[2]),
                "Removal by \"Object\" failed - existing.");
            
            $this->assertFalse($accountManager->removeAccount(new MfaAccount("E", "F")),
                "Removal by \"Object\" failed - non-existing.");
            
            $this->assertFalse($accountManager->removeAccount(new MfaAccount()),
                "Removal by \"Object\" failed - no parameters.");
            
            // Step 5 - Test Invalid Removal Method
            
            try
            {
                $accountManager->removeAccount(new MfaSecret());
                
                $this->fail("Exception should've been thrown!");
            }
            catch (\Exception $e)
            {
                $this->assertEquals("Option couldn't be determined.",
                    $e->getMessage());
            }
        }
        
        /**
         * Tests <i>findAccount</i> method of the <i>AccountManager</i> class.
         * 
         * Note: Finding by Account ID.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2024 All Rights Reserved
         * @version   1.0.0
         * 
         * @return void
         */
        public function testFindAccountByIdMethod()
        {
            // Core Variables
            
            $accountManager = new MfaAccountManager();
            $account        = null;
            
            // Other Variables
            
            $testAccounts = [
                new MfaAccount("A", "B", new MfaSecret()),
                new MfaAccount("C", "D", new MfaSecret()),
                new MfaAccount("E", "F", new MfaSecret()),
                new MfaAccount("G", "H", new MfaSecret()),
                new MfaAccount("I", "J", new MfaSecret())
            ];
            
            // Step 1 - Set Accounts
            
            $accountManager->setAccounts($testAccounts);
            
            // Step 2 - Test Finding By ID
            
            $account = $accountManager->findAccount(1);
            
            $this->assertSame("A", $account->getServiceName());
            
            $account = $accountManager->findAccount(1337);
            
            $this->assertSame(null, $account);
        }
        
        /**
         * Tests <i>findAccount</i> method of the <i>AccountManager</i> class.
         * 
         * Note: Finding by Account Name.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2024 All Rights Reserved
         * @version   1.0.0
         * 
         * @return void
         */
        public function testFindAccountByNameMethod()
        {
            // Core Variables
            
            $accountManager = new MfaAccountManager();
            $account        = null;
            
            // Other Variables
            
            $testAccounts = [
                new MfaAccount("A", "B", new MfaSecret()),
                new MfaAccount("C", "D", new MfaSecret()),
                new MfaAccount("E", "F", new MfaSecret()),
                new MfaAccount("G", "H", new MfaSecret()),
                new MfaAccount("I", "J", new MfaSecret())
            ];
            
            // Step 1 - Set Accounts
            
            $accountManager->setAccounts($testAccounts);
            
            // Step 2- Test Finding By Name
            
            $account = $accountManager->findAccount("D");
            
            $this->assertSame("C", $account->getServiceName());
            
            $account = $accountManager->findAccount("Cake is a lie!");
            
            $this->assertSame(null, $account);
        }
        
        /**
         * Tests <i>findAccount</i> method of the <i>AccountManager</i> class.
         * 
         * Note: Finding by Account Object.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2024 All Rights Reserved
         * @version   1.0.0
         * 
         * @return void
         */
        public function testFindAccountByObjectMethod()
        {
            // Core Variables
            
            $accountManager = new MfaAccountManager();
            $account        = null;
            
            // Other Variables
            
            $testAccounts = [
                new MfaAccount("A", "B", new MfaSecret()),
                new MfaAccount("C", "D", new MfaSecret()),
                new MfaAccount("E", "F", new MfaSecret()),
                new MfaAccount("G", "H", new MfaSecret()),
                new MfaAccount("I", "J", new MfaSecret())
            ];
            
            // Step 1 - Set Accounts
            
            $accountManager->setAccounts($testAccounts);
            
            // Step 2 - Test Finding By Object
            
            $account = $accountManager->findAccount($testAccounts[2]);
            
            $this->assertSame("E", $account->getServiceName());
            
            $account = $accountManager->findAccount(new MfaAccount("E", "F"));
            
            $this->assertSame("E", $account->getServiceName());
            
            $account = $accountManager->findAccount(new MfaAccount());
            
            $this->assertSame(null, $account);
        }
        
        /**
         * Tests <i>findAccount</i> method of the <i>AccountManager</i> class.
         * 
         * Note: Invalid option passed.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2024 All Rights Reserved
         * @version   1.0.0
         * 
         * @return void
         */
        public function testFindAccountMethodInvalid()
        {
            // Core Variables
            
            $accountManager = new MfaAccountManager();
            
            // Other Variables
            
            $testAccounts = [
                new MfaAccount("A", "B", new MfaSecret()),
                new MfaAccount("C", "D", new MfaSecret()),
                new MfaAccount("E", "F", new MfaSecret()),
                new MfaAccount("G", "H", new MfaSecret()),
                new MfaAccount("I", "J", new MfaSecret())
            ];
            
            // Step 1 - Set Accounts
            
            $accountManager->setAccounts($testAccounts);
            
            // Step 2 - Attempt Finding
            
            try
            {
                $accountManager->findAccount(new MfaSecret());
                
                $this->fail("Exception should've been thrown!");
            }
            catch (\Exception $e)
            {
                $this->assertEquals("Option couldn't be determined.",
                    $e->getMessage());
            }
        }
        
        /**
         * Tests <i>save</i> and <i>load</i> methods of the project.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2024 All Rights Reserved
         * @version   1.0.0
         * 
         * @return void
         */
        public function testSaveLoad()
        {
            // Core Variables
            
            $accountManager = new MfaAccountManager();
            $saveLocation   = sys_get_temp_dir() . DIRECTORY_SEPARATOR . "ga";
            
            // Other Variables
            
            $testAccounts = [
                new MfaAccount("A", "B", new MfaSecret()),
                new MfaAccount("C", "D", new MfaSecret()),
                new MfaAccount("E", "F", new MfaSecret()),
                new MfaAccount("G", "H", new MfaSecret()),
                new MfaAccount("I", "J", new MfaSecret())
            ];
            
            // Step 1 - Save Accounts
            
            $accountManager->setAccounts($testAccounts);
            
            $this->assertTrue($accountManager->save($saveLocation),
                "Accounts couldn't be saved.");
            
            // Step 2 - Load Accounts
            
            $this->assertTrue($accountManager->load($saveLocation),
                "Accounts couldn't be loaded.");
            
            // Step 3 - Check Loaded Accounts
            
            $loadAccounts = $accountManager->getAccounts();
            
            foreach ($loadAccounts as $accountKey => $accountObject)
            {
                $this->assertSame($accountObject->getServiceName(),
                    $testAccounts[$accountKey]->getServiceName());
            }
            
            // Step 4 - Test Invalid Save & Load
            
            $tmp = sys_get_temp_dir();
            
            $this->assertFalse($accountManager->save($tmp),
                "\"TMP\" should be a directory.");
            
            $this->assertFalse($accountManager->load($tmp),
                "\"TMP\" shouldn't be a readable file.");
        }
    }
    
?>
