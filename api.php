<?php
// API credentials
$apiKey = 'xxx';
$apiSecret = 'xxx';
$passphrase = 'xxx'; // Your passphrase

// Tüm Pozisyonları Almak için Fonksiyon
function getAllPositions($apiKey, $apiSecret, $passphrase) {
    $timestamp = round(microtime(true) * 1000); // Current timestamp
    $method = 'GET'; // HTTP method
    $requestPath = '/api/v2/mix/position/all-position'; // Endpoint for getting all positions
    $queryString = 'productType=USDT-FUTURES&marginCoin=USDT'; // Parameters for position data
    $body = ''; // GET request has no body

    // Create the signature string
    $signContent = $timestamp . strtoupper($method) . $requestPath . '?' . $queryString . $body;

    // Generate HMAC SHA256 signature
    $signature = hash_hmac('sha256', $signContent, $apiSecret, true);

    // Base64 encode the signature
    $encodedSignature = base64_encode($signature);

    // Set up headers for the API request
    $headers = [
        "ACCESS-KEY: $apiKey",
        "ACCESS-SIGN: $encodedSignature",
        "ACCESS-PASSPHRASE: $passphrase",
        "ACCESS-TIMESTAMP: $timestamp",
        "locale: en-US",
        "Content-Type: application/json"
    ];

    // Initialize cURL session
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.bitget.com/api/v2/mix/position/all-position?productType=USDT-FUTURES&marginCoin=USDT");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    // Execute the cURL request
    $response = curl_exec($ch);

    // Handle cURL errors
    if (curl_errno($ch)) {
        echo 'Error: ' . curl_error($ch);
        return false;
    }

    curl_close($ch);

    // Decode and return the response
    $responseData = json_decode($response, true);
    
    return $responseData;
}


//`getAllPositions($apiKey, $apiSecret, $passphrase);` fonksiyonu, tüm pozisyonları alır ve çıktıyı döndürür.
  
  
  
// Place Order Function
function placeOrder($apiKey, $apiSecret, $passphrase, $symbol, $productType, $marginMode, $marginCoin, $size, $price = null, $side, $tradeSide = null, $orderType, $force = 'gtc', $clientOid = null, $reduceOnly = 'NO', $presetStopSurplusPrice = null, $presetStopLossPrice = null, $stpMode = 'none') {
    $timestamp = round(microtime(true) * 1000); // Current timestamp
    $method = 'POST'; // HTTP method
    $requestPath = '/api/v2/mix/order/place-order'; // Endpoint for placing an order
    $body = [
        'symbol' => $symbol,
        'productType' => $productType,
        'marginMode' => $marginMode,
        'marginCoin' => $marginCoin,
        'size' => $size,
        'price' => $price,
        'side' => $side,
        'tradeSide' => $tradeSide,
        'orderType' => $orderType,
        'force' => $force,
        'clientOid' => $clientOid,
        'reduceOnly' => $reduceOnly,
        'presetStopSurplusPrice' => $presetStopSurplusPrice,
        'presetStopLossPrice' => $presetStopLossPrice,
        'stpMode' => $stpMode
    ];

    // Remove keys with null values
    $body = array_filter($body, function($value) {
        return !is_null($value);
    });

    // Encode body to JSON
    $bodyJson = json_encode($body);

    // Create the signature string
    $signContent = $timestamp . strtoupper($method) . $requestPath . $bodyJson;

    // Generate HMAC SHA256 signature
    $signature = hash_hmac('sha256', $signContent, $apiSecret, true);

    // Base64 encode the signature
    $encodedSignature = base64_encode($signature);

    // Set up headers for the API request
    $headers = [
        "ACCESS-KEY: $apiKey",
        "ACCESS-SIGN: $encodedSignature",
        "ACCESS-PASSPHRASE: $passphrase",
        "ACCESS-TIMESTAMP: $timestamp",
        "locale: en-US",
        "Content-Type: application/json"
    ];

    // Initialize cURL session
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.bitget.com/api/v2/mix/order/place-order");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $bodyJson);

    // Execute the cURL request
    $response = curl_exec($ch);

    // Handle cURL errors
    if (curl_errno($ch)) {
        echo 'Error: ' . curl_error($ch);
        return false;
    }

    curl_close($ch);

    // Decode and return the response
    return json_decode($response, true);
}



//placeOrder($apiKey, $apiSecret, $passphrase, 'ETHUSDT', 'USDT-FUTURES', 'isolated', 'USDT', '0.1', '2000', 'sell', 'open', 'limit', 'gtc', '121211212122');



// Click Backhand Order Function
function clickBackhandOrder($apiKey, $apiSecret, $passphrase, $symbol, $productType, $marginCoin, $size, $side = null, $tradeSide = null, $clientOid = null) {
    $timestamp = round(microtime(true) * 1000); // Current timestamp
    $method = 'POST'; // HTTP method
    $requestPath = '/api/v2/mix/order/click-backhand'; // Endpoint for placing the click backhand order
    $body = [
        'symbol' => $symbol,
        'productType' => $productType,
        'marginCoin' => $marginCoin,
        'size' => $size,
        'side' => $side,
        'tradeSide' => $tradeSide,
        'clientOid' => $clientOid
    ];

    // Remove keys with null values
    $body = array_filter($body, function($value) {
        return !is_null($value);
    });

    // Encode body to JSON
    $bodyJson = json_encode($body);

    // Create the signature string
    $signContent = $timestamp . strtoupper($method) . $requestPath . $bodyJson;

    // Generate HMAC SHA256 signature
    $signature = hash_hmac('sha256', $signContent, $apiSecret, true);

    // Base64 encode the signature
    $encodedSignature = base64_encode($signature);

    // Set up headers for the API request
    $headers = [
        "ACCESS-KEY: $apiKey",
        "ACCESS-SIGN: $encodedSignature",
        "ACCESS-PASSPHRASE: $passphrase",
        "ACCESS-TIMESTAMP: $timestamp",
        "locale: en-US",
        "Content-Type: application/json"
    ];

    // Initialize cURL session
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.bitget.com/api/v2/mix/order/click-backhand");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $bodyJson);

    // Execute the cURL request
    $response = curl_exec($ch);

    // Handle cURL errors
    if (curl_errno($ch)) {
        echo 'Error: ' . curl_error($ch);
        return false;
    }

    curl_close($ch);

    // Decode and return the response
    return json_decode($response, true);
}

// Usage example
// $response = clickBackhandOrder($apiKey, $apiSecret, $passphrase, 'ethusdt', 'USDT-FUTURES', 'USDT', '30', 'buy', 'Open', '12345');





// Batch Place Order Function
function batchPlaceOrder($apiKey, $apiSecret, $passphrase, $symbol, $productType, $marginMode, $marginCoin, $orderList) {
    $timestamp = round(microtime(true) * 1000); // Current timestamp
    $method = 'POST'; // HTTP method
    $requestPath = '/api/v2/mix/order/batch-place-order'; // Endpoint for placing batch orders
    $body = [
        'symbol' => $symbol,
        'productType' => $productType,
        'marginMode' => $marginMode,
        'marginCoin' => $marginCoin,
        'orderList' => $orderList
    ];

    // Encode body to JSON
    $bodyJson = json_encode($body);

    // Create the signature string
    $signContent = $timestamp . strtoupper($method) . $requestPath . $bodyJson;

    // Generate HMAC SHA256 signature
    $signature = hash_hmac('sha256', $signContent, $apiSecret, true);

    // Base64 encode the signature
    $encodedSignature = base64_encode($signature);

    // Set up headers for the API request
    $headers = [
        "ACCESS-KEY: $apiKey",
        "ACCESS-SIGN: $encodedSignature",
        "ACCESS-PASSPHRASE: $passphrase",
        "ACCESS-TIMESTAMP: $timestamp",
        "locale: en-US",
        "Content-Type: application/json"
    ];

    // Initialize cURL session
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.bitget.com/api/v2/mix/order/batch-place-order");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $bodyJson);

    // Execute the cURL request
    $response = curl_exec($ch);

    // Handle cURL errors
    if (curl_errno($ch)) {
        echo 'Error: ' . curl_error($ch);
        return false;
    }

    curl_close($ch);

    // Decode and return the response
    return json_decode($response, true);
}

// Usage example
$orderList = [
    [
        'size' => '1',
        'side' => 'buy',
        'tradeSide' => 'open',
        'orderType' => 'market',
        'force' => 'gtc',
        'clientOid' => '123456',
        'reduceOnly' => 'NO',
        'presetStopSurplusPrice' => '20000',
        'presetStopLossPrice' => '10000'
    ]
];

// $response = batchPlaceOrder($apiKey, $apiSecret, $passphrase, 'BTCUSDT', 'usdt-futures', 'crossed', 'USDT', $orderList);

// Modify Order Function
function modifyOrder($apiKey, $apiSecret, $passphrase, $orderId, $newClientOid, $symbol, $productType, $marginCoin, $newSize, $newPrice) {
    $timestamp = round(microtime(true) * 1000); // Current timestamp
    $method = 'POST'; // HTTP method
    $requestPath = '/api/v2/mix/order/modify-order'; // Endpoint for modifying an order
    $body = [
        'orderId' => $orderId,
        'newClientOid' => $newClientOid,
        'symbol' => $symbol,
        'productType' => $productType,
        'marginCoin' => $marginCoin,
        'newSize' => $newSize,
        'newPrice' => $newPrice
    ];

    // Encode body to JSON
    $bodyJson = json_encode($body);

    // Create the signature string
    $signContent = $timestamp . strtoupper($method) . $requestPath . $bodyJson;

    // Generate HMAC SHA256 signature
    $signature = hash_hmac('sha256', $signContent, $apiSecret, true);

    // Base64 encode the signature
    $encodedSignature = base64_encode($signature);

    // Set up headers for the API request
    $headers = [
        "ACCESS-KEY: $apiKey",
        "ACCESS-SIGN: $encodedSignature",
        "ACCESS-PASSPHRASE: $passphrase",
        "ACCESS-TIMESTAMP: $timestamp",
        "locale: en-US",
        "Content-Type: application/json"
    ];

    // Initialize cURL session
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.bitget.com/api/v2/mix/order/modify-order");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $bodyJson);

    // Execute the cURL request
    $response = curl_exec($ch);

    // Handle cURL errors
    if (curl_errno($ch)) {
        echo 'Error: ' . curl_error($ch);
        return false;
    }

    curl_close($ch);

    // Decode and return the response
    return json_decode($response, true);
}

// Usage example
$response = modifyOrder(
    $apiKey, 
    $apiSecret, 
    $passphrase, 
    '1',  // Order ID
    '1212112121223',  // New Client Order ID
    'ETHUSDT',  // Trading pair
    'usdt-futures',  // Product type
    'USDT',  // Margin Coin
    '0.04',  // New Size
    '1800.00'  // New Price
);



// Cancel Order Function
function cancelOrder($apiKey, $apiSecret, $passphrase, $orderId, $symbol, $productType, $marginCoin) {
    $timestamp = round(microtime(true) * 1000); // Current timestamp
    $method = 'POST'; // HTTP method
    $requestPath = '/api/v2/mix/order/cancel-order'; // Endpoint for cancelling an order
    $body = [
        'orderId' => $orderId,
        'symbol' => $symbol,
        'productType' => $productType,
        'marginCoin' => $marginCoin
    ];

    // Encode body to JSON
    $bodyJson = json_encode($body);

    // Create the signature string
    $signContent = $timestamp . strtoupper($method) . $requestPath . $bodyJson;

    // Generate HMAC SHA256 signature
    $signature = hash_hmac('sha256', $signContent, $apiSecret, true);

    // Base64 encode the signature
    $encodedSignature = base64_encode($signature);

    // Set up headers for the API request
    $headers = [
        "ACCESS-KEY: $apiKey",
        "ACCESS-SIGN: $encodedSignature",
        "ACCESS-PASSPHRASE: $passphrase",
        "ACCESS-TIMESTAMP: $timestamp",
        "locale: en-US",
        "Content-Type: application/json"
    ];

    // Initialize cURL session
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.bitget.com/api/v2/mix/order/cancel-order");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $bodyJson);

    // Execute the cURL request
    $response = curl_exec($ch);

    // Handle cURL errors
    if (curl_errno($ch)) {
        echo 'Error: ' . curl_error($ch);
        return false;
    }

    curl_close($ch);

    // Decode and return the response
    return json_decode($response, true);
}

// Usage example
$response = cancelOrder(
    $apiKey, 
    $apiSecret, 
    $passphrase, 
    '1',  // Order ID
    'BTCUSDT',  // Trading pair
    'usdt-futures',  // Product type
    'USDT'  // Margin Coin
);



// Batch Cancel Orders Function
function batchCancelOrders($apiKey, $apiSecret, $passphrase, $symbol, $productType, $marginCoin, $orderIdList) {
    $timestamp = round(microtime(true) * 1000); // Current timestamp
    $method = 'POST'; // HTTP method
    $requestPath = '/api/v2/mix/order/batch-cancel-orders'; // Endpoint for batch cancelling orders
    $body = [
        'symbol' => $symbol,
        'productType' => $productType,
        'marginCoin' => $marginCoin,
        'orderIdList' => $orderIdList
    ];

    // Encode body to JSON
    $bodyJson = json_encode($body);

    // Create the signature string
    $signContent = $timestamp . strtoupper($method) . $requestPath . $bodyJson;

    // Generate HMAC SHA256 signature
    $signature = hash_hmac('sha256', $signContent, $apiSecret, true);

    // Base64 encode the signature
    $encodedSignature = base64_encode($signature);

    // Set up headers for the API request
    $headers = [
        "ACCESS-KEY: $apiKey",
        "ACCESS-SIGN: $encodedSignature",
        "ACCESS-PASSPHRASE: $passphrase",
        "ACCESS-TIMESTAMP: $timestamp",
        "locale: zh-CN",
        "Content-Type: application/json"
    ];

    // Initialize cURL session
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.bitget.com/api/v2/mix/order/batch-cancel-orders");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $bodyJson);

    // Execute the cURL request
    $response = curl_exec($ch);

    // Handle cURL errors
    if (curl_errno($ch)) {
        echo 'Error: ' . curl_error($ch);
        return false;
    }

    curl_close($ch);

    // Decode and return the response
    return json_decode($response, true);
}

// Usage example
$response = batchCancelOrders(
    $apiKey, 
    $apiSecret, 
    $passphrase, 
    'BTCUSDT',  // Trading pair
    'usdt-futures',  // Product type
    'USDT',  // Margin Coin
    [['orderId' => '121211212122']]  // List of order IDs to cancel
);



// FLASH Close Positions Function
function closePositions($apiKey, $apiSecret, $passphrase, $symbol, $productType, $holdSide) {
    $timestamp = round(microtime(true) * 1000); // Current timestamp
    $method = 'POST'; // HTTP method
    $requestPath = '/api/v2/mix/order/close-positions'; // Endpoint for closing positions
    $body = [
        'symbol' => $symbol,
        'productType' => $productType,
        'holdSide' => $holdSide
    ];

    // Encode body to JSON
    $bodyJson = json_encode($body);

    // Create the signature string
    $signContent = $timestamp . strtoupper($method) . $requestPath . $bodyJson;

    // Generate HMAC SHA256 signature
    $signature = hash_hmac('sha256', $signContent, $apiSecret, true);

    // Base64 encode the signature
    $encodedSignature = base64_encode($signature);

    // Set up headers for the API request
    $headers = [
        "ACCESS-KEY: $apiKey",
        "ACCESS-SIGN: $encodedSignature",
        "ACCESS-PASSPHRASE: $passphrase",
        "ACCESS-TIMESTAMP: $timestamp",
        "locale: zh-CN",
        "Content-Type: application/json"
    ];

    // Initialize cURL session
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.bitget.com/api/v2/mix/order/close-positions");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $bodyJson);

    // Execute the cURL request
    $response = curl_exec($ch);

    // Handle cURL errors
    if (curl_errno($ch)) {
        echo 'Error: ' . curl_error($ch);
        return false;
    }

    curl_close($ch);

    // Decode and return the response
    return json_decode($response, true);
}

// Usage example
$response = closePositions(
    $apiKey, 
    $apiSecret, 
    $passphrase, 
    'BTCUSDT',  // Trading pair
    'USDT-FUTURES',  // Product type
    'long'  // Hold side ('long' or 'short')
);


// Get Order Details Function
function getOrderDetails($apiKey, $apiSecret, $passphrase, $symbol, $orderId, $clientOid, $productType) {
    $timestamp = round(microtime(true) * 1000); // Current timestamp
    $method = 'GET'; // HTTP method
    $requestPath = '/api/v2/mix/order/detail'; // Endpoint for getting order details

    // Prepare the query parameters
    $queryParams = [
        'symbol' => $symbol,
        'orderId' => $orderId,
        'clientOid' => $clientOid,
        'productType' => $productType
    ];

    // Build query string from parameters
    $queryString = http_build_query($queryParams);

    // Create the signature string
    $signContent = $timestamp . strtoupper($method) . $requestPath . '?' . $queryString;

    // Generate HMAC SHA256 signature
    $signature = hash_hmac('sha256', $signContent, $apiSecret, true);

    // Base64 encode the signature
    $encodedSignature = base64_encode($signature);

    // Set up headers for the API request
    $headers = [
        "ACCESS-KEY: $apiKey",
        "ACCESS-SIGN: $encodedSignature",
        "ACCESS-PASSPHRASE: $passphrase",
        "ACCESS-TIMESTAMP: $timestamp",
        "locale: zh-CN",
        "Content-Type: application/json"
    ];

    // Initialize cURL session
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.bitget.com/api/v2/mix/order/detail?" . $queryString);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    // Execute the cURL request
    $response = curl_exec($ch);

    // Handle cURL errors
    if (curl_errno($ch)) {
        echo 'Error: ' . curl_error($ch);
        return false;
    }

    curl_close($ch);

    // Decode and return the response
    return json_decode($response, true);
}

// Usage example
$response = getOrderDetails(
    $apiKey, 
    $apiSecret, 
    $passphrase, 
    'ETHUSDT',  // Trading pair
    '1',  // Order ID
    '1',  // Client Order ID
    'usdt-futures'  // Product type
);



// Get Fills Details Function
function getFillsDetails($apiKey, $apiSecret, $passphrase, $productType) {
    $timestamp = round(microtime(true) * 1000); // Current timestamp
    $method = 'GET'; // HTTP method
    $requestPath = '/api/v2/mix/order/fills'; // Endpoint for getting fills details

    // Prepare the query parameters
    $queryParams = [
        'productType' => $productType
    ];

    // Build query string from parameters
    $queryString = http_build_query($queryParams);

    // Create the signature string
    $signContent = $timestamp . strtoupper($method) . $requestPath . '?' . $queryString;

    // Generate HMAC SHA256 signature
    $signature = hash_hmac('sha256', $signContent, $apiSecret, true);

    // Base64 encode the signature
    $encodedSignature = base64_encode($signature);

    // Set up headers for the API request
    $headers = [
        "ACCESS-KEY: $apiKey",
        "ACCESS-SIGN: $encodedSignature",
        "ACCESS-PASSPHRASE: $passphrase",
        "ACCESS-TIMESTAMP: $timestamp",
        "locale: zh-CN",
        "Content-Type: application/json"
    ];

    // Initialize cURL session
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.bitget.com/api/v2/mix/order/fills?" . $queryString);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    // Execute the cURL request
    $response = curl_exec($ch);

    // Handle cURL errors
    if (curl_errno($ch)) {
        echo 'Error: ' . curl_error($ch);
        return false;
    }

    curl_close($ch);

    // Decode and return the response
    return json_decode($response, true);
}

// Usage example
$response = getFillsDetails(
    $apiKey, 
    $apiSecret, 
    $passphrase, 
    'usdt-futures'  // Product type
);



// Get Fill History Function
function getFillHistory($apiKey, $apiSecret, $passphrase, $productType) {
    $timestamp = round(microtime(true) * 1000); // Current timestamp
    $method = 'GET'; // HTTP method
    $requestPath = '/api/v2/mix/order/fill-history'; // Endpoint for getting fill history

    // Prepare the query parameters
    $queryParams = [
        'productType' => $productType
    ];

    // Build query string from parameters
    $queryString = http_build_query($queryParams);

    // Create the signature string
    $signContent = $timestamp . strtoupper($method) . $requestPath . '?' . $queryString;

    // Generate HMAC SHA256 signature
    $signature = hash_hmac('sha256', $signContent, $apiSecret, true);

    // Base64 encode the signature
    $encodedSignature = base64_encode($signature);

    // Set up headers for the API request
    $headers = [
        "ACCESS-KEY: $apiKey",
        "ACCESS-SIGN: $encodedSignature",
        "ACCESS-PASSPHRASE: $passphrase",
        "ACCESS-TIMESTAMP: $timestamp",
        "locale: zh-CN",
        "Content-Type: application/json"
    ];

    // Initialize cURL session
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.bitget.com/api/v2/mix/order/fill-history?" . $queryString);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    // Execute the cURL request
    $response = curl_exec($ch);

    // Handle cURL errors
    if (curl_errno($ch)) {
        echo 'Error: ' . curl_error($ch);
        return false;
    }

    curl_close($ch);

    // Decode and return the response
    return json_decode($response, true);
}

// Usage example
$response = getFillHistory(
    $apiKey, 
    $apiSecret, 
    $passphrase, 
    'usdt-futures'  // Product type
);


// Get Pending Orders Function
function getPendingOrders($apiKey, $apiSecret, $passphrase, $productType) {
    $timestamp = round(microtime(true) * 1000); // Current timestamp
    $method = 'GET'; // HTTP method
    $requestPath = '/api/v2/mix/order/orders-pending'; // Endpoint for getting pending orders

    // Prepare the query parameters
    $queryParams = [
        'productType' => $productType
    ];

    // Build query string from parameters
    $queryString = http_build_query($queryParams);

    // Create the signature string
    $signContent = $timestamp . strtoupper($method) . $requestPath . '?' . $queryString;

    // Generate HMAC SHA256 signature
    $signature = hash_hmac('sha256', $signContent, $apiSecret, true);

    // Base64 encode the signature
    $encodedSignature = base64_encode($signature);

    // Set up headers for the API request
    $headers = [
        "ACCESS-KEY: $apiKey",
        "ACCESS-SIGN: $encodedSignature",
        "ACCESS-PASSPHRASE: $passphrase",
        "ACCESS-TIMESTAMP: $timestamp",
        "locale: zh-CN",
        "Content-Type: application/json"
    ];

    // Initialize cURL session
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.bitget.com/api/v2/mix/order/orders-pending?" . $queryString);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    // Execute the cURL request
    $response = curl_exec($ch);

    // Handle cURL errors
    if (curl_errno($ch)) {
        echo 'Error: ' . curl_error($ch);
        return false;
    }

    curl_close($ch);

    // Decode and return the response
    return json_decode($response, true);
}

// Usage example
$response = getPendingOrders(
    $apiKey, 
    $apiSecret, 
    $passphrase, 
    'usdt-futures'  // Product type
);


// Get Order History Function
function getOrderHistory($apiKey, $apiSecret, $passphrase, $productType) {
    $timestamp = round(microtime(true) * 1000); // Current timestamp
    $method = 'GET'; // HTTP method
    $requestPath = '/api/v2/mix/order/orders-history'; // Endpoint for getting order history

    // Prepare the query parameters
    $queryParams = [
        'productType' => $productType
    ];

    // Build query string from parameters
    $queryString = http_build_query($queryParams);

    // Create the signature string
    $signContent = $timestamp . strtoupper($method) . $requestPath . '?' . $queryString;

    // Generate HMAC SHA256 signature
    $signature = hash_hmac('sha256', $signContent, $apiSecret, true);

    // Base64 encode the signature
    $encodedSignature = base64_encode($signature);

    // Set up headers for the API request
    $headers = [
        "ACCESS-KEY: $apiKey",
        "ACCESS-SIGN: $encodedSignature",
        "ACCESS-PASSPHRASE: $passphrase",
        "ACCESS-TIMESTAMP: $timestamp",
        "locale: zh-CN",
        "Content-Type: application/json"
    ];

    // Initialize cURL session
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.bitget.com/api/v2/mix/order/orders-history?" . $queryString);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    // Execute the cURL request
    $response = curl_exec($ch);

    // Handle cURL errors
    if (curl_errno($ch)) {
        echo 'Error: ' . curl_error($ch);
        return false;
    }

    curl_close($ch);

    // Decode and return the response
    return json_decode($response, true);
}

// Usage example
$response = getOrderHistory(
    $apiKey, 
    $apiSecret, 
    $passphrase, 
    'usdt-futures'  // Product type
);


// Cancel All Orders Function
function cancelAllOrders($apiKey, $apiSecret, $passphrase, $symbol, $productType, $marginCoin) {
    $timestamp = round(microtime(true) * 1000); // Current timestamp
    $method = 'POST'; // HTTP method
    $requestPath = '/api/v2/mix/order/cancel-all-orders'; // Endpoint for canceling all orders

    // Prepare the request body
    $body = json_encode([
        'symbol' => $symbol,
        'productType' => $productType,
        'marginCoin' => $marginCoin
    ]);

    // Create the signature string
    $signContent = $timestamp . strtoupper($method) . $requestPath . $body;

    // Generate HMAC SHA256 signature
    $signature = hash_hmac('sha256', $signContent, $apiSecret, true);

    // Base64 encode the signature
    $encodedSignature = base64_encode($signature);

    // Set up headers for the API request
    $headers = [
        "ACCESS-KEY: $apiKey",
        "ACCESS-SIGN: $encodedSignature",
        "ACCESS-PASSPHRASE: $passphrase",
        "ACCESS-TIMESTAMP: $timestamp",
        "locale: zh-CN",
        "Content-Type: application/json"
    ];

    // Initialize cURL session
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.bitget.com/api/v2/mix/order/cancel-all-orders");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $body);

    // Execute the cURL request
    $response = curl_exec($ch);

    // Handle cURL errors
    if (curl_errno($ch)) {
        echo 'Error: ' . curl_error($ch);
        return false;
    }

    curl_close($ch);

    // Decode and return the response
    return json_decode($response, true);
}

// Usage example
$response = cancelAllOrders(
    $apiKey, 
    $apiSecret, 
    $passphrase, 
    'BTCUSDT',  // Symbol
    'USDT-FUTURES',  // Product Type
    'USDT'  // Margin Coin
);



// Plan Sub Order Function
function planSubOrder($apiKey, $apiSecret, $passphrase, $planOrderId, $productType, $planType) {
    $timestamp = round(microtime(true) * 1000); // Current timestamp
    $method = 'POST'; // HTTP method
    $requestPath = '/api/v2/mix/order/plan-sub-order'; // Endpoint for plan sub-order

    // Prepare the request body
    $body = json_encode([
        'planOrderId' => $planOrderId,
        'productType' => $productType,
        'planType' => $planType
    ]);

    // Create the signature string
    $signContent = $timestamp . strtoupper($method) . $requestPath . $body;

    // Generate HMAC SHA256 signature
    $signature = hash_hmac('sha256', $signContent, $apiSecret, true);

    // Base64 encode the signature
    $encodedSignature = base64_encode($signature);

    // Set up headers for the API request
    $headers = [
        "ACCESS-KEY: $apiKey",
        "ACCESS-SIGN: $encodedSignature",
        "ACCESS-PASSPHRASE: $passphrase",
        "ACCESS-TIMESTAMP: $timestamp",
        "locale: en-US",
        "Content-Type: application/json"
    ];

    // Initialize cURL session
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.bitget.com/api/v2/mix/order/plan-sub-order");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $body);

    // Execute the cURL request
    $response = curl_exec($ch);

    // Handle cURL errors
    if (curl_errno($ch)) {
        echo 'Error: ' . curl_error($ch);
        return false;
    }

    curl_close($ch);

    // Decode and return the response
    return json_decode($response, true);
}

// Usage example
$response = planSubOrder(
    $apiKey, 
    $apiSecret, 
    $passphrase, 
    'xxxxxxxxxxxxxxxxxx',  // Plan Order ID
    'USDT-FUTURES',  // Product Type
    'normal_plan'  // Plan Type
);




// Place TPSL Order Function
function placeTpslOrder($apiKey, $apiSecret, $passphrase, $marginCoin, $productType, $symbol, $planType, $triggerPrice, $triggerType, $executePrice, $holdSide, $size, $rangeRate, $clientOid) {
    $timestamp = round(microtime(true) * 1000); // Current timestamp
    $method = 'POST'; // HTTP method
    $requestPath = '/api/v2/mix/order/place-tpsl-order'; // Endpoint for placing TPSL order

    // Prepare the request body
    $body = json_encode([
        'marginCoin' => $marginCoin,
        'productType' => $productType,
        'symbol' => $symbol,
        'planType' => $planType,
        'triggerPrice' => $triggerPrice,
        'triggerType' => $triggerType,
        'executePrice' => $executePrice,
        'holdSide' => $holdSide,
        'size' => $size,
        'rangeRate' => $rangeRate,
        'clientOid' => $clientOid
    ]);

    // Create the signature string
    $signContent = $timestamp . strtoupper($method) . $requestPath . $body;

    // Generate HMAC SHA256 signature
    $signature = hash_hmac('sha256', $signContent, $apiSecret, true);

    // Base64 encode the signature
    $encodedSignature = base64_encode($signature);

    // Set up headers for the API request
    $headers = [
        "ACCESS-KEY: $apiKey",
        "ACCESS-SIGN: $encodedSignature",
        "ACCESS-PASSPHRASE: $passphrase",
        "ACCESS-TIMESTAMP: $timestamp",
        "locale: en-US",
        "Content-Type: application/json"
    ];

    // Initialize cURL session
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.bitget.com/api/v2/mix/order/place-tpsl-order");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $body);

    // Execute the cURL request
    $response = curl_exec($ch);

    // Handle cURL errors
    if (curl_errno($ch)) {
        echo 'Error: ' . curl_error($ch);
        return false;
    }

    curl_close($ch);

    // Decode and return the response
    return json_decode($response, true);
}

// Usage example
$response = placeTpslOrder(
    $apiKey, 
    $apiSecret, 
    $passphrase, 
    'USDT',  // Margin Coin
    'usdt-futures',  // Product Type
    'ethusdt',  // Symbol
    'profit_plan',  // Plan Type
    '2000',  // Trigger Price
    'mark_price',  // Trigger Type
    '0',  // Execute Price
    'long',  // Hold Side
    '1',  // Size
    '',  // Range Rate (optional)
    '1234'  // Client Oid
);


// Place POS TPSL Order Function
function placePosTpslOrder($apiKey, $apiSecret, $passphrase, $marginCoin, $productType, $symbol, $stopSurplusTriggerPrice, $stopSurplusTriggerType, $stopSurplusExecutePrice, $stopLossTriggerPrice, $stopLossTriggerType, $stopLossExecutePrice, $holdSide) {
    $timestamp = round(microtime(true) * 1000); // Current timestamp
    $method = 'POST'; // HTTP method
    $requestPath = '/api/v2/mix/order/place-pos-tpsl'; // Endpoint for placing POS TPSL order

    // Prepare the request body
    $body = json_encode([
        'marginCoin' => $marginCoin,
        'productType' => $productType,
        'symbol' => $symbol,
        'stopSurplusTriggerPrice' => $stopSurplusTriggerPrice,
        'stopSurplusTriggerType' => $stopSurplusTriggerType,
        'stopSurplusExecutePrice' => $stopSurplusExecutePrice,
        'stopLossTriggerPrice' => $stopLossTriggerPrice,
        'stopLossTriggerType' => $stopLossTriggerType,
        'stopLossExecutePrice' => $stopLossExecutePrice,
        'holdSide' => $holdSide
    ]);

    // Create the signature string
    $signContent = $timestamp . strtoupper($method) . $requestPath . $body;

    // Generate HMAC SHA256 signature
    $signature = hash_hmac('sha256', $signContent, $apiSecret, true);

    // Base64 encode the signature
    $encodedSignature = base64_encode($signature);

    // Set up headers for the API request
    $headers = [
        "ACCESS-KEY: $apiKey",
        "ACCESS-SIGN: $encodedSignature",
        "ACCESS-PASSPHRASE: $passphrase",
        "ACCESS-TIMESTAMP: $timestamp",
        "locale: en-US",
        "Content-Type: application/json"
    ];

    // Initialize cURL session
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.bitget.com/api/v2/mix/order/place-pos-tpsl");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $body);

    // Execute the cURL request
    $response = curl_exec($ch);

    // Handle cURL errors
    if (curl_errno($ch)) {
        echo 'Error: ' . curl_error($ch);
        return false;
    }

    curl_close($ch);

    // Decode and return the response
    return json_decode($response, true);
}

// Usage example
$response = placePosTpslOrder(
    $apiKey, 
    $apiSecret, 
    $passphrase, 
    'USDT',  // Margin Coin
    'usdt-futures',  // Product Type
    'BTCUSDT',  // Symbol
    '69000',  // Stop Surplus Trigger Price
    'mark_price',  // Stop Surplus Trigger Type
    '69001',  // Stop Surplus Execute Price
    '55001',  // Stop Loss Trigger Price
    'mark_price',  // Stop Loss Trigger Type
    '55000',  // Stop Loss Execute Price
    'long'  // Hold Side
);



// Place Plan Order Function
function placePlanOrder($apiKey, $apiSecret, $passphrase, $planType, $symbol, $productType, $marginMode, $marginCoin, $size, $price, $triggerPrice, $triggerType, $side, $tradeSide, $orderType, $clientOid) {
    $timestamp = round(microtime(true) * 1000); // Current timestamp
    $method = 'POST'; // HTTP method
    $requestPath = '/api/v2/mix/order/place-plan-order'; // Endpoint for placing a plan order

    // Prepare the request body
    $body = json_encode([
        'planType' => $planType,
        'symbol' => $symbol,
        'productType' => $productType,
        'marginMode' => $marginMode,
        'marginCoin' => $marginCoin,
        'size' => $size,
        'price' => $price,
        'callbackRatio' => '',
        'triggerPrice' => $triggerPrice,
        'triggerType' => $triggerType,
        'side' => $side,
        'tradeSide' => $tradeSide,
        'orderType' => $orderType,
        'clientOid' => $clientOid,
        'reduceOnly' => 'NO',
        'presetStopSurplusPrice' => '',
        'stopSurplusTriggerPrice' => '',
        'stopSurplusTriggerType' => '',
        'presetStopLossPrice' => '',
        'stopLossTriggerPrice' => '',
        'stopLossTriggerType' => ''
    ]);

    // Create the signature string
    $signContent = $timestamp . strtoupper($method) . $requestPath . $body;

    // Generate HMAC SHA256 signature
    $signature = hash_hmac('sha256', $signContent, $apiSecret, true);

    // Base64 encode the signature
    $encodedSignature = base64_encode($signature);

    // Set up headers for the API request
    $headers = [
        "ACCESS-KEY: $apiKey",
        "ACCESS-SIGN: $encodedSignature",
        "ACCESS-PASSPHRASE: $passphrase",
        "ACCESS-TIMESTAMP: $timestamp",
        "locale: en-US",
        "Content-Type: application/json"
    ];

    // Initialize cURL session
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.bitget.com/api/v2/mix/order/place-plan-order");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $body);

    // Execute the cURL request
    $response = curl_exec($ch);

    // Handle cURL errors
    if (curl_errno($ch)) {
        echo 'Error: ' . curl_error($ch);
        return false;
    }

    curl_close($ch);

    // Decode and return the response
    return json_decode($response, true);
}

// Usage example
$response = placePlanOrder(
    $apiKey, 
    $apiSecret, 
    $passphrase, 
    'normal_plan',  // Plan Type
    'BTCUSDT',  // Symbol
    'usdt-futures',  // Product Type
    'isolated',  // Margin Mode
    'USDT',  // Margin Coin
    '0.01',  // Size
    '24000',  // Price
    '24100',  // Trigger Price
    'mark_price',  // Trigger Type
    'buy',  // Side
    'open',  // Trade Side
    'limit',  // Order Type
    '121212121212'  // Client Order ID
);



// Modify TPSL Order Function
function modifyTpslOrder($apiKey, $apiSecret, $passphrase, $orderId, $clientOid, $marginCoin, $productType, $symbol, $triggerPrice, $triggerType, $executePrice, $size) {
    $timestamp = round(microtime(true) * 1000); // Current timestamp
    $method = 'POST'; // HTTP method
    $requestPath = '/api/v2/mix/order/modify-tpsl-order'; // Endpoint for modifying TPSL orders

    // Prepare the request body
    $body = json_encode([
        'orderId' => $orderId,
        'clientOid' => $clientOid,
        'marginCoin' => $marginCoin,
        'productType' => $productType,
        'symbol' => $symbol,
        'triggerPrice' => $triggerPrice,
        'triggerType' => $triggerType,
        'executePrice' => $executePrice,
        'size' => $size,
        'rangeRate' => ''
    ]);

    // Create the signature string
    $signContent = $timestamp . strtoupper($method) . $requestPath . $body;

    // Generate HMAC SHA256 signature
    $signature = hash_hmac('sha256', $signContent, $apiSecret, true);

    // Base64 encode the signature
    $encodedSignature = base64_encode($signature);

    // Set up headers for the API request
    $headers = [
        "ACCESS-KEY: $apiKey",
        "ACCESS-SIGN: $encodedSignature",
        "ACCESS-PASSPHRASE: $passphrase",
        "ACCESS-TIMESTAMP: $timestamp",
        "locale: en-US",
        "Content-Type: application/json"
    ];

    // Initialize cURL session
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.bitget.com/api/v2/mix/order/modify-tpsl-order");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $body);

    // Execute the cURL request
    $response = curl_exec($ch);

    // Handle cURL errors
    if (curl_errno($ch)) {
        echo 'Error: ' . curl_error($ch);
        return false;
    }

    curl_close($ch);

    // Decode and return the response
    return json_decode($response, true);
}

// Usage example
$response = modifyTpslOrder(
    $apiKey, 
    $apiSecret, 
    $passphrase, 
    '1',  // Order ID
    '2',  // Client Order ID
    'USDT',  // Margin Coin
    'usdt-futures',  // Product Type
    'ethusdt',  // Symbol
    '2001',  // Trigger Price
    'fill_price',  // Trigger Type
    '0',  // Execute Price
    '2'   // Size
);




// Modify Plan Order Function
function modifyPlanOrder($apiKey, $apiSecret, $passphrase, $orderId, $clientOid, $symbol, $newSize, $newPrice, $newTriggerPrice, $newTriggerType, $newStopSurplusExecutePrice, $newStopSurplusTriggerPrice, $newStopSurplusTriggerType, $newStopLossExecutePrice, $newStopLossTriggerPrice, $newStopLossTriggerType) {
    $timestamp = round(microtime(true) * 1000); // Current timestamp
    $method = 'POST'; // HTTP method
    $requestPath = '/api/v2/mix/order/modify-plan-order'; // Endpoint for modifying plan orders

    // Prepare the request body
    $body = json_encode([
        'planType' => 'normal_plan',
        'orderId' => $orderId,
        'clientOid' => $clientOid,
        'symbol' => $symbol,
        'productType' => 'usdt-futures',
        'newSize' => $newSize,
        'newPrice' => $newPrice,
        'newCallbackRatio' => '',
        'newTriggerPrice' => $newTriggerPrice,
        'newTriggerType' => $newTriggerType,
        'newStopSurplusExecutePrice' => $newStopSurplusExecutePrice,
        'newStopSurplusTriggerPrice' => $newStopSurplusTriggerPrice,
        'newStopSurplusTriggerType' => $newStopSurplusTriggerType,
        'newStopLossExecutePrice' => $newStopLossExecutePrice,
        'newStopLossTriggerPrice' => $newStopLossTriggerPrice,
        'newStopLossTriggerType' => $newStopLossTriggerType
    ]);

    // Create the signature string
    $signContent = $timestamp . strtoupper($method) . $requestPath . $body;

    // Generate HMAC SHA256 signature
    $signature = hash_hmac('sha256', $signContent, $apiSecret, true);

    // Base64 encode the signature
    $encodedSignature = base64_encode($signature);

    // Set up headers for the API request
    $headers = [
        "ACCESS-KEY: $apiKey",
        "ACCESS-SIGN: $encodedSignature",
        "ACCESS-PASSPHRASE: $passphrase",
        "ACCESS-TIMESTAMP: $timestamp",
        "locale: en-US",
        "Content-Type: application/json"
    ];

    // Initialize cURL session
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.bitget.com/api/v2/mix/order/modify-plan-order");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $body);

    // Execute the cURL request
    $response = curl_exec($ch);

    // Handle cURL errors
    if (curl_errno($ch)) {
        echo 'Error: ' . curl_error($ch);
        return false;
    }

    curl_close($ch);

    // Decode and return the response
    return json_decode($response, true);
}

// Usage example
$response = modifyPlanOrder(
    $apiKey, 
    $apiSecret, 
    $passphrase, 
    '123',  // Order ID
    '321123',  // Client Order ID
    'ethusdt',  // Symbol
    '3',  // New Size
    '2001',  // New Price
    '2000',  // New Trigger Price
    'fill_price',  // New Trigger Type
    '2049',  // New Stop Surplus Execute Price
    '2050',  // New Stop Surplus Trigger Price
    'mark_price',  // New Stop Surplus Trigger Type
    '5',  // New Stop Loss Execute Price
    '1970',  // New Stop Loss Trigger Price
    'mark_price'  // New Stop Loss Trigger Type
);



// Orders Plan Pending Function
function getOrdersPlanPending($apiKey, $apiSecret, $passphrase, $orderId, $clientOid, $planType, $productType) {
    $timestamp = round(microtime(true) * 1000); // Current timestamp
    $method = 'GET'; // HTTP method
    $requestPath = '/api/v2/mix/order/orders-plan-pending'; // Endpoint for querying pending orders

    // Prepare the query parameters
    $queryParams = [
        'orderId' => $orderId,
        'clientOid' => $clientOid,
        'planType' => $planType,
        'productType' => $productType
    ];

    // Construct the full request URL with query parameters
    $queryString = http_build_query($queryParams);
    $url = "https://api.bitget.com" . $requestPath . "?" . $queryString;

    // Create the signature string
    $signContent = $timestamp . strtoupper($method) . $requestPath . $queryString;

    // Generate HMAC SHA256 signature
    $signature = hash_hmac('sha256', $signContent, $apiSecret, true);

    // Base64 encode the signature
    $encodedSignature = base64_encode($signature);

    // Set up headers for the API request
    $headers = [
        "ACCESS-KEY: $apiKey",
        "ACCESS-SIGN: $encodedSignature",
        "ACCESS-PASSPHRASE: $passphrase",
        "ACCESS-TIMESTAMP: $timestamp",
        "locale: en-US",
        "Content-Type: application/json"
    ];

    // Initialize cURL session
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

    // Execute the cURL request
    $response = curl_exec($ch);

    // Handle cURL errors
    if (curl_errno($ch)) {
        echo 'Error: ' . curl_error($ch);
        return false;
    }

    curl_close($ch);

    // Decode and return the response
    return json_decode($response, true);
}

// Usage example
$response = getOrdersPlanPending(
    $apiKey, 
    $apiSecret, 
    $passphrase, 
    '123',  // Order ID
    '1234',  // Client Order ID
    'profit_loss',  // Plan Type
    'USDT-FUTURES'  // Product Type
);



// Cancel Plan Order Function
function cancelPlanOrder($apiKey, $apiSecret, $passphrase, $orderIdList, $symbol, $productType, $marginCoin) {
    $timestamp = round(microtime(true) * 1000); // Current timestamp
    $method = 'POST'; // HTTP method
    $requestPath = '/api/v2/mix/order/cancel-plan-order'; // Endpoint for canceling plan orders

    // Prepare the data to be sent in the request body
    $data = [
        'orderIdList' => $orderIdList,
        'symbol' => $symbol,
        'productType' => $productType,
        'marginCoin' => $marginCoin
    ];

    // Convert data array to JSON
    $jsonData = json_encode($data);

    // Create the signature string
    $signContent = $timestamp . strtoupper($method) . $requestPath . $jsonData;

    // Generate HMAC SHA256 signature
    $signature = hash_hmac('sha256', $signContent, $apiSecret, true);

    // Base64 encode the signature
    $encodedSignature = base64_encode($signature);

    // Set up headers for the API request
    $headers = [
        "ACCESS-KEY: $apiKey",
        "ACCESS-SIGN: $encodedSignature",
        "ACCESS-PASSPHRASE: $passphrase",
        "ACCESS-TIMESTAMP: $timestamp",
        "locale: en-US",
        "Content-Type: application/json"
    ];

    // Initialize cURL session
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.bitget.com" . $requestPath);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);

    // Execute the cURL request
    $response = curl_exec($ch);

    // Handle cURL errors
    if (curl_errno($ch)) {
        echo 'Error: ' . curl_error($ch);
        return false;
    }

    curl_close($ch);

    // Decode and return the response
    return json_decode($response, true);
}

// Usage example
$orderIdList = [
    ['orderId' => '123', 'clientOid' => '321'],
    ['orderId' => '', 'clientOid' => '666'],
    ['orderId' => '123', 'clientOid' => '']
];

$response = cancelPlanOrder(
    $apiKey, 
    $apiSecret, 
    $passphrase, 
    $orderIdList,  // List of order IDs to be canceled
    'ETHUSDT',  // Symbol
    'USDT-FUTURES',  // Product Type
    'USDT'  // Margin Coin
);


?>
