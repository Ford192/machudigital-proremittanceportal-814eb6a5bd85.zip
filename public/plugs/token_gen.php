<?php

function gen_token()
{
  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://shop.digitaltermination.com/oauth/token",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "grant_type=password&client_secret=GCTLAPlN6LtI3ZMr4Z9hbXPQbbAs9ADN8K7VLxHw&client_id=19&username=integrations%40ghana.accessbankplc.com&password=ebLsVKydb54qR3Yk4e8z2aCMxuXzDi",
    CURLOPT_HTTPHEADER => array(
      "cache-control: no-cache",
      "content-type: application/x-www-form-urlencoded",
      "postman-token: 753defe2-59b3-777b-92ca-1f862d24b79b"
    ),
  ));

  $response = curl_exec($curl);
  $err = curl_error($curl);

  curl_close($curl);

  if ($err) {
    echo "cURL Error #:" . $err;
    return 0;
  } else {
    return $response;
  }
}

function token_check($connection)
{
  $dat = date("Y-m-d H:i:s");
  $aili = $connection->query("SELECT * FROM `tokens` WHERE `status` = 0 ");
  if($aili->rowCount())
  {
    $vsl = 100;
    while($maid = $aili->fetch(PDO::FETCH_ASSOC))
    {
      if(strtotime("+20 days ",strtotime($maid['request_on'])) < $dat)
      {
        $maili = $connection->prepare("UPDATE `tokens` SET `status`=1 WHERE `id` = ? ");
        $maili->execute(array($maid['id']));

        $vsl = 0;
      }
    }
    return $vsl;
  }
  else
    {
      return 0;
    }
  // $maili->execute(array($user_email));
  // $maili_num = $maili->rowCount(); 
}

function get_transaction_details($connection, $t_id)
{
  $get_tok = $connection->query('SELECT * FROM `tokens` WHERE `status` = 0 ')->fetch(PDO::FETCH_ASSOC)['token'];
  
  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://shop.digitaltermination.com/api/transactions/".$t_id."/cash-pick-ups/look-up",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
      "accept: application/json",
      "authorization:".$get_tok,
      "cache-control: no-cache",
      "postman-token: 349dd314-cb72-723a-6141-83b9f65d2a76"
    ),
  ));

  $response = curl_exec($curl);
  $err = curl_error($curl);

  curl_close($curl);

  if ($err) {
    // echo "cURL Error #:" . $err;
    return 0;

  } else {

    return json_decode($response, true);
  }
}
