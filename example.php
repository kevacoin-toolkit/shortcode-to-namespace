<?php

error_reporting(0);

include("rpc.php");

$kpc = new Keva();

$kpc->username=$krpcuser;
$kpc->password=$krpcpass;
$kpc->host=$krpchost;
$kpc->port=$krpcport;

$comm="62107953";

$blength=substr($comm , 0 , 1);
$block=substr($comm , 1 , $blength);
$btxn=$blength+1;
$btx=substr($comm , $btxn);

$blockhash= $kpc->getblockhash(intval($block));

$blockdata= $kpc->getblock($blockhash);

$txa=$blockdata['tx'][$btx];
				
		$transaction= $kpc->getrawtransaction($txa,1);

					foreach($transaction['vout'] as $vout)
	   
						  {

					$op_return = $vout["scriptPubKey"]["asm"]; 

				
					$arr = explode(' ', $op_return); 

					if($arr[0] == 'OP_KEVA_NAMESPACE') 
								{

								 $cona=$arr[0];
								 $cons=$arr[1];
								 $conk=$arr[2];
								

								}
						  }
				
				$asset=Base58Check::encode( $cons, false , 0 , false);

				$namespace= $kpc->keva_get($asset,"_KEVA_NS_");

				$title=$namespace['value'];

								
echo "Namespace: ".$title."<br><br>";
echo  $asset."<br><br>";
echo "Short code: ".$comm;




?>