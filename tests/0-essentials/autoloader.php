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
    
    /**
     * <i>TestAutoloader</i> class is used for testing project's autoloader.
     * 
     * @author    Djordje Jocic <office@djordjejocic.com>
     * @copyright 2024 All Rights Reserved
     * @version   1.0.0
     */
    class Autoloader extends TestCase
    {
        /*******************\
        |* PRIMARY METHODS *|
        \*******************/
        
        /**
         * Tests the project's autoloading function.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2024 All Rights Reserved
         * @version   1.0.0
         * 
         * @return void
         */
        public function testFunction()
        {
            // Core Variables
            
            $testValues = [
                
                "\Jocic\GoogleAuthenticator\Account"        => true,
                "\Jocic\GoogleAuthenticator\Account"        => true,
                "\Jocic\GoogleAuthenticator\AccountManager" => true,
                "\Jocic\GoogleAuthenticator\AccountManager" => true,
                "\Jocic\GoogleAuthenticator\Helper"         => true,
                "\Jocic\GoogleAuthenticator\Helper"         => true,
                "\Jocic\GoogleAuthenticator\Secret"         => true,
                "\Jocic\GoogleAuthenticator\Secret"         => true,
                "\Jocic\GoogleAuthenticator\Validator"      => true,
                "\Jocic\GoogleAuthenticator\Validator"      => true,
                
                "\Jocic\GoogleAuthenticator\Account1"        => false,
                "\Jocic\GoogleAuthenticator\Acc1ount"        => false,
                "\Jocic\GoogleAuthenticator\Accountt"        => false,
                "\Jocic\GoogleAuthenticator\Acc ount"        => false,
                "\Jocic\GoogleAuthenticator\ Account"        => false,
                "\Jocic\GoogleAuthenticator\AcOuNt"          => false,
                "\Jocic\GoogleAuthenticator\Account Manager" => false,
                "\Jocic\GoogleAuthenticator\Potato"          => false,
                
            ];
            
            // Logic
            
            foreach ($testValues as $testValue => $testResult)
            {
                $this->assertSame($testResult,
                    load_google_authenticator_class($testValue), $testValue);
            }
        }
    }
    
?>
