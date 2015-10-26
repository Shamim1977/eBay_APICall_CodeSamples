<?php

error_reporting(E_ALL);  // Turn on all errors, warnings and notices for easier debugging

//Seller Authorization Token
$userAuthToken= 'Authorization:TOKEN AgAAAA**AQAAAA**aAAAAA**ex1KVQ**nY+sHZ2PrBmdj6wVnY+sEZ2PrA2dj6AEkYSlAZOKpQudj6x9nY+seQ**KD0AAA**AAMAAA**R2GkXq9yqj+37wfexq4j4JUEzybsq7hmsq8zvM+WmvMwFhC7Q9A2VRCqd+rtQf2Ie3flc+KQhck8KbuNfrk//5uVFT3ch8rfQCHRWDuBIN/aKfPyNa2mLulJpZR6s0IYHnm0XLm9uq+mgNHorpA9++HYoM9xmaMlwtsHv78X/1hQgwAcHfAJtx8mft5FjelW7uflmesPz4e6T8+9MYm1XbqkJj6ACl/4HZqT22LamA957oqhjmoxtBUzudF0qA/5qWbZrWEVMZD+obSWajCQ6pttGVCAtoflwzSm6/zmjXAJvEYsZjC4iEA93QiYXRTOLK0h2ExFyy0vCwgVi67TBDVIEgRPCXC36EY+jx4odRaZABtH8lg1GvKpxtRlXAmuf9ImTTuSgld54m4ObxlanL5RfcqgABOzoBmk0d0UworOFSAw8rDmpq+WJhsC5XSPrRnnq9oQFRpbKrStWDmWIo+d73CFY5YzU2zVpt2e5DZhW/KCM6mM0RHiNC2UlDMDjJOSNUpCbdNGh7nsd2AaVXHb7O0W44DpxTzK+31CMeLWm3AUzIA0k7V28J0id5TN4HQCXh58JOORKs3J8giZxq5SDEFaEsEk/9SST/0Tc7i1WSvK0bQfVSeEK43RcaQsRTymVBnqNrFiHcWuE2Ocg7wah2aWrFTRpXWU1PYYChrQLU8oTYwSKGGESIkT8TmBQZrzkNYGT0RCs6A96o6No3oN/Shd9E8CNf0T9bfnBxdC4gQmurdyF01T4Rjgg+Gh';

//Endpoint URL to Use
$url = "https://svcs.ebay.com/services/selling/listingrecommendation/v1/item/recommendationItemIds?recommendationType=ItemSpecifics&pageNumber=1&entriesPerPage=1";

//Initializle cURL
$connection = curl_init();

//Set Endpoint URL
curl_setopt($connection,CURLOPT_URL,$url);

//Set HTTP Method
curl_setopt($connection, CURLOPT_HTTPGET, true);

//Create Array of  Required Headers
$headers = array();
$headers[] = $userAuthToken;
$headers[] = 'X-EBAY-GLOBAL-ID:EBAY-US';

//set the headers using the array of headers
curl_setopt($connection,CURLOPT_HTTPHEADER,$headers);

//set it to return the transfer as a string from curl_exec
curl_setopt($connection,CURLOPT_RETURNTRANSFER,1);

//stop CURL from verifying the peer's certificate
curl_setopt($connection, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($connection, CURLOPT_SSL_VERIFYHOST, 0);

//Execute the Request
$response = curl_exec($connection);

//close the connection
curl_close($connection);

//Check If Response is OK
if (stristr($response, 'HTTP 404') || $response == '')
	die('<P>Error sending request, Please check the Request');

$data=json_decode($response,true);
if ($data === NULL) die('Error parsing json');
$entries='';
$entries = $data['pagination']['totalEntries'];


?>
<!-- Print the Required Fileds in table format -->
<table border='1px'>
<?php

if ($entries == 0){
	echo "Hurray! No Items to Recommend";
} else {
foreach	($data['items'] as $itemID);


echo '<tr><tH style="background-color:#E6E6FA; border-radius:20px"> <b>'."Number of Items Found For Recommendation =" .$entries.'</b></tH></tr>';
echo '<tr><th style="background-color:#E6E6FA; border-radius:20px">Below Is One of the ItemID That has ItemSpecifics Recommendation, Please Check itemRecommendations Call to See Recommendations</th></tr>';
$itemID1=$data['items'];
echo '<tr><td> <b>'.implode(", ",$itemID1).'</b></td></tr>';

	
	echo '</tr>';
}
echo '</table>';
?>



