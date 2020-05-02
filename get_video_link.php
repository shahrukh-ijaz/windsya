<?php
    // $slug="BombasticDepressedAntMVGame";
    $client_id = "7v4acmi5udki7hj4j1cbacpqdpacd1";
    $search = $_POST['search'];
    $search = explode("/", $search);
    $search = $search[count($search)-1];
    
    $slug = explode("?", $search)[0];    

    $url = "https://api.twitch.tv/helix/clips?id=".$slug;
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 0);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Client-ID: '.$client_id)); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $output = curl_exec($ch);
    curl_close($ch);

    $output = json_decode($output, true);
    $thumb_url = $output['data'][0]['thumbnail_url'];
    $slice_point = explode('-preview-', $thumb_url)[0];
   
    $mp4_url = $slice_point . '.mp4';    
    $title = $output['data'][0]['title'];
    $title = str_replace($title, ' ', '_');
    
    $data = array(
        'url' => $mp4_url,
        'title' => $title
    );
    print_r(json_encode($data));

?>