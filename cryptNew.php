<?php
    //Initialize Key Crypt class
    $crypt = new keyCrypt();
    
    //To generate new key
    $New_Key = $crypt->keyGenerate(127);
    //keyGenerate returns an array. Index 0: key string. Index 1 array of library indexes
    
    //To Scramble to key for storage
    $New_Key_Scrambled = $crypt->keyScramble($New_Key[1]);
    
    //To UnScramble key
    $UnScrambled_Key = $crypt->keyUnScramble($New_Key_Scrambled);

    class keyCrypt
    {
       protected $library = array(
         0=>'a', 1=>'b', 2=>'c', 3=>'d', 4=>'e', 5=>'f', 6=>'g', 7=>'h', 8=>'i', 9=>'j', 10=>'k', 11=>'l', 12=>'m', 13=>'n', 14=>'o', 15=>'p', 16=>'q', 17=>'r', 18=>'s', 19=>'t', 20=>'u', 21=>'v', 22=>'w', 23=>'x', 24=>'y', 25=>'z',
         26=>'!', 27=>'@', 28=>'#', 29=>'$', 30=>'%', 31=>'^', 32=>'&', 33=>'*', 34=>'(', 35=>')', 36=>'-', 37=>'_', 38=>'=', 39=>'+', 40=>'[', 41=>'{', 42=>']', 43=>'}', 44=>',', 
         45=>'A', 44=>'B', 45=>'C', 46=>'D', 47=>'E', 48=>'F', 49=>'G', 50=>'H', 51=>'I', 52=>'J', 53=>'K', 54=>'L', 55=>'M', 56=>'N', 57=>'O', 58=>'P', 59=>'Q', 60=>'R', 61=>'S', 62=>'T', 63=>'U', 64=>'V', 65=>'W', 66=>'X', 67=>'Y', 68=>'Z',
         69=>'1', 70=>'2', 71=>'3', 72=>'4', 73=>'5', 74=>'6', 75=>'7', 76=>'8', 77=>'9', 78=>'0');
        
        protected $siteKey = 'ad&lsylj[WxG3z9&FZY=0XWi^6R(9dTd+}BcOPpWPRjKtu6b1v4sv&4fl3wUvY}eO]xf(-)lebSCO^P{GJcu(wBdt0L1&dOu6nYP=e_zP1_9clEER_^C$y2ot!qMD&';
        public function keyGenerate($charLeg){
            $keyString = '';
            $keyStringArray = array();
            for($i = 0; $i < $charLeg; $i++){
                $randomNumber = mt_rand(0, 78);
                $keyString .= $this->library[$randomNumber];
                $keyStringArray[] = $randomNumber;
            }
            return array($keyString, $keyStringArray);;
        }
        public function keyScramble($key){
            $siteKeySplit = str_split($this->siteKey);
            $deckA = array();
            $deckB = array();
            $returnedKey = $key;
            for($a = 0; $a < 7; $a++){
                for($i = 0; $i < count($siteKeySplit); $i++){
                    $index = array_search($siteKeySplit[$i], $this->library);
                    if($index%2 == 0){
                        $deckA[] = $returnedKey[$i];
                    }else{
                        $deckB[] = $returnedKey[$i];
                    }
                }
                unset($returnedKey);
                for($i = 0; $i < count($deckB); $i++){
                    $returnedKey[] = $deckB[$i];
                }
                for($i = 0; $i < count($deckA); $i++){
                    $returnedKey[] = $deckA[$i];
                }
                unset($deckA);
                unset($deckB);
            }
            return implode('|', $returnedKey);
        }
        public function keyUnScramble($key){

            $siteKeySplit = str_split($this->siteKey);
            $deckA = array();
            $deckB = array();
            $returnedKey = explode('|', $key);
            $deckALegnth = 0;
            $deckBLegnth = 0;
            for($i = 0; $i < count($siteKeySplit); $i++){
                $index = array_search($siteKeySplit[$i], $this->library);
                if($index%2 == 0){
                    $deckALegnth++;
                }else{
                    $deckBLegnth++;
                }
            }
            for($a = 0; $a < 7; $a++){
                for($i = 0; $i < $deckBLegnth; $i++){
                    $deckB[] = $returnedKey[$i];
                }
                for($i = $deckBLegnth; $i < count($returnedKey); $i++){
                    $deckA[] = $returnedKey[$i];
                }
                unset($returnedKey);
                $deckAinc = 0;
                $deckBinc = 0;
                for($i = 0; $i < count($siteKeySplit); $i++){
                    $index = array_search($siteKeySplit[$i], $this->library);
                    if($index%2 === 0){
                        $returnedKey[] = $deckA[$deckAinc];
                        $deckAinc++;
                    }else{
                        $returnedKey[] = $deckB[$deckBinc];
                        $deckBinc++;
                    }
                }
                unset($deckA);
                unset($deckB);
            }
            return $returnedKey;
        }
    }
?>
