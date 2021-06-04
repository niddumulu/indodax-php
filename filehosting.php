<?php
    $url = 'https://indodax.com/tapi';
    $key = $_GET['getKey'];
    $secretKey = $_GET['getSecret'];
    $methode = $_GET['method'];
    $type = $_GET['type'];

    if($methode == "getInfo"){

		$data = [
	        'method' => $_GET['method'],
	        'timestamp' => '1578304294000',
	        'recvWindow' => '1578303937000'
	    ];

    } elseif ($methode == "cancelOrder" ) {
        
		$data = [
			'method' => $_GET['method'],
			'timestamp' => '1578304294000',
			'recvWindow' => '1578303937000',
			'pair' => $_GET['pair'],
			'order_id' => $_GET['order_id'],
			'type' => $_GET['type'],
         ];
    
    } elseif ($methode == "getOrder" ) {
        
		$data = [
			'method' => $_GET['method'],
			'timestamp' => '1578304294000',
			'recvWindow' => '1578303937000',
			'pair' => $_GET['pair'],
			'order_id' => $_GET['order_id'],
         ];
    
    } elseif ($methode == "openOrders" ) {
        
		$data = [
			'method' => $_GET['method'],
			'timestamp' => '1578304294000',
			'recvWindow' => '1578303937000',
			'pair' => $_GET['pair'],
         ];
    
    }elseif ($methode == "trade" && $type == "buy" ) {
     
		$data = [
			'method' => $_GET['method'],
			'timestamp' => '1578304294000',
			'recvWindow' => '1578303937000',
			'pair' => $_GET['pair'],
			'type' => $_GET['type'],
			'price' => $_GET['price'],
			'idr' => $_GET['idr'],
         ];
    
    } elseif ($methode == "trade" && $type == "sell" ) {

		$koin = $_GET['koin'];
		$jumlah = $_GET['jumlah'];
       
		$data = [
			'method' => $_GET['method'],
			'timestamp' => '1578304294000',
			'recvWindow' => '1578303937000',
			'pair' => $_GET['pair'],
			'type' => $_GET['type'],
			'price' => $_GET['price'],
         ];

		 $data[$koin] = $jumlah;
    
    } elseif ($methode == "orderHistory") {

		$data = [
	        'method' => $_GET['method'],
	        'timestamp' => '1578304294000',
	        'recvWindow' => '1578303937000',
            'pair' => $_GET['pair'],
	    ];

    }
    
	elseif ($methode == "tradeHistory") {

		$data = [
	        'method' => $_GET['method'],
	        'timestamp' => '1578304294000',
	        'recvWindow' => '1578303937000',	
            'pair' => $_GET['pair'],
	    ];

    }
    $post_data = http_build_query($data, '', '&');
    $sign = hash_hmac('sha512', $post_data, $secretKey);
    
    $headers = ['Key:'.$key,'Sign:'.$sign];

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_HTTPHEADER => $headers,
        CURLOPT_URL => $url,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $data,
        CURLOPT_RETURNTRANSFER => true
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    echo $response;

?>
