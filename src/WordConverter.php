<?php

namespace Kalam\TakaConverter;


class WordConverter extends AbstractConverter {

    public function convert()
    {

        return $this->convertToWord($this->amount);
    }

    private function convertUpToLac($amount)
    {
        $word = '';
        //Lac
        if( strlen($amount) >= self::LAC ) { // lac
            $chunkLength = (strlen($amount) - ( self::LAC - 1));
            $chunkAmount = substr($amount, 0, $chunkLength );
            $amount = substr($amount, $chunkLength) ;
            if( $chunkAmount > 0 ) {
                $word .= $this->taka[$chunkAmount * 1]  . ' লক্ষ ';
            }

        }

        // Thousand
        if( strlen($amount) >= self::THOUSAND ) { // thousand
            $chunkLength = (strlen($amount) - ( self::THOUSAND - 1));
            $chunkAmount = substr($amount, 0, $chunkLength );
            $amount = substr($amount, $chunkLength) ;
            if( $chunkAmount > 0 ) {
                $word .= $this->taka[$chunkAmount * 1] . ' হাজার ';
            }
        }

        // Hundred
        if( strlen($amount) >= self::HUNDRED ) {
            $chunkLength = (strlen($amount) - ( self::HUNDRED - 1));
            $chunkAmount = substr($amount, 0, $chunkLength );
            $amount = substr($amount, $chunkLength) ;
            if( $chunkAmount > 0 ) {
                $word .= $this->taka[$chunkAmount * 1] . ' শত ';
            }
        }

        if( $amount > 0 ) {
            $word .= $this->taka[$amount * 1];
        }

        return $word;
    }

    protected function convertToWord($amount)
    {        
        $word = '';
        $splitAmounts = preg_split("/\./", round($amount,2));
        $amount = $splitAmounts[0];        
   
        if( strlen($amount) >= self::CRORE  ) { // crore
            $chunkLength = (strlen($amount) - ( self::CRORE - 1));
            $chunkAmount = substr($amount, 0, $chunkLength);
            $amount = substr($amount, $chunkLength) ;
            $word .= $this->convertUpToLac($chunkAmount)  . ' কোটি ';
        }

        $word .= $this->convertUpToLac($amount);

        if( isset($splitAmounts[1]) ) {
            $word .= ' and ' . $this->taka[ $splitAmounts[1]] . ' পয়সা';
        }
        
        $word .= ' মাত্র';

        return ucwords($word) ;
    }
}
