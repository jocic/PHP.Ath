<?php
    
    /*******************************************************************\
    |* Author: Djordje Jocic                                           *|
    |* Year: 2018                                                      *|
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
    
    /**
     * <i>TestAccount</i> class is used for testing method implementation of the
     * class <i>Account</i>.
     * 
     * @author    Djordje Jocic <office@djordjejocic.com>
     * @copyright 2018 All Rights Reserved
     * @version   1.0.0
     */
    
    class TestAccount extends TestCase
    {
        /*********************\
        |* GET & SET METHODS *|
        \*********************/
        
        /**
         * Tests <i>setAccountId</i> & <i>getAccountId</i> methods.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2018 All Rights Reserved
         * @version   1.0.0
         * 
         * @return void
         */
        
        public function testAccountIdMethods()
        {
            // Core Variables
            
            $account = new MfaAccount();
            
            // Step 1 - Test Initial Setting
            
            $account->setAccountId(1337);
            
            $this->assertSame(1337, $account->getAccountId());
            
            // Step 2 - Test Repeated Setting
            
            try
            {
                $account->setAccountId(1337);
                
                $this->fail("Exception should've been thrown!");
            }
            catch (\Exception $e)
            {
                $this->assertEquals("ID was already assigned.",
                    $e->getMessage());
            }
        }
        
        /**
         * Tests <i>setServiceName</i> & <i>getServiceName</i> methods.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2018 All Rights Reserved
         * @version   1.0.0
         * 
         * @return void
         */
        
        public function testServiceNameMethods()
        {
            // Core Variables
            
            $account = new MfaAccount();
            
            // Other Variables
            
            $testValues = [
                "Hosting ABC",
                "FastFood Joint",
                "That Shop"
            ];
            
            // Logic
            
            foreach ($testValues as $testValue)
            {
                $account->setServiceName($testValue);
                
                $this->assertSame($testValue, $account->getServiceName());
            }
        }
        
        /**
         * Tests <i>setAccountName</i> & <i>getAccountName</i> methods.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2018 All Rights Reserved
         * @version   1.0.0
         * 
         * @return void
         */
        
        public function testAccountNameMethods()
        {
            // Core Variables
            
            $account = new MfaAccount();
            
            // Other Variables
            
            $testValues = [
                "John Doe",
                "john@doe.com",
                "Buyer McBuyerson"
            ];
            
            // Logic
            
            foreach ($testValues as $testValue)
            {
                $account->setAccountName($testValue);
                
                $this->assertSame($testValue, $account->getAccountName());
            }
        }
        
        /**
         * Tests <i>setAccountSecret</i> & <i>getAccountSecret</i> methods.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2018 All Rights Reserved
         * @version   1.0.0
         * 
         * @return void
         */
        
        public function testAccountSecretMethods()
        {
            // Core Variables
            
            $account = new MfaAccount();
            
            // Other Variables
            
            $testSecrets = [
                new MfaSecret(),
                new MfaSecret(),
                new MfaSecret()
            ];
            
            // Logic
            
            foreach ($testSecrets as $testSecret)
            {
                $account->setAccountSecret($testSecret);
                
                $this->assertSame($testSecret, $account->getAccountSecret());
            }
        }
        
        /*****************\
        |* CHECK METHODS *|
        \*****************/
        
        // CHECK METHODS GO HERE
        
        /*******************\
        |* PRIMARY METHODS *|
        \*******************/
        
        /**
         * Tests constructor of the class.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2018 All Rights Reserved
         * @version   1.0.0
         * 
         * @return void
         */
        
        public function testConstructor()
        {
            // Core Variables
            
            $account = null;
            
            // Other Variables
            
            $testValues = [
                [ null,  null,  null ],
                [ "",  "",  null ],
                [ "A", "B", new MfaSecret() ]
            ];
            
            // Logic
            
            foreach ($testValues as $testValue)
            {
                $account = new MfaAccount($testValue[0],
                    $testValue[1], $testValue[2]);
                
                $this->assertSame($testValue[0],
                    $account->getServiceName(), "getServiceName");
                
                $this->assertSame($testValue[1],
                    $account->getAccountName(), "getAccountName");
                
                $this->assertSame($testValue[2],
                    $account->getAccountSecret(), "getAccountSecret");
            }
        }
    }
    
?>
