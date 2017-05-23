<?php
	function publish_pushNotification($mobile,$message){ // Pass Mobile Number and Message as Paramters. Mobile number should be mapped with Device Id.
		
		$qry	=	"select *from optra_app_install_device"; // Device Id's to be captured 
		$res	=	$this->db->query($qry);
		if($res->result()){
		
			foreach($res->result() as $row){
				
				$data[]	=	$row->device_id;
			}
		}
		
		try{
			$url = 'https://fcm.googleapis.com/fcm/send';
			/* $id = "f6O5mIH3VME:APA91bEl0XbPgyCyr6mlYyEuKdPSR-Vry7wKr8ZverY0GSNMh2ga0ouzqYSOwhvnzruZib8dcLZvyAgmcAzYiAUa-V9l-To7XKLP56HENWYnDpgBoJoeLsHdCQ7q-wyW3xDzFOaaBEuM";
			$id1 = "c04kKXckLJI:APA91bE7TsLzB8ySAUMBsAEgtZVGlYYeqCxVGKukCsiM_a2lFEcDCR9Dj4_b-yB41sns4IkjdY-1J90cAir15zVPp6WG907gTDSqF9fwoQoDJT2LL9e-9LCvJj2iipiCuuUAcDYykDHJ";
			$id2 = "fzABBjmH63M:APA91bHTAmSI762EiZlSvrcZHa4Zbp5zke6ognv5sQBi9eSFzzdrd2vNIu79--AlA7KCO90dTxnJndbPzIWJUDpt4vCGu1lBsk16CcDqQtkdkuiq1dk703bsF1lmREwNiczTrdTbynL1";
			$id3 = "d_2TUv-VKwc:APA91bGXHt3umB7nkaiIrpEz-aeU151Q4asbadzcOwvBqZ9tkSd5qld4t0dOkOzXkJU5vSFNzgJ5jlbMNokPC4Kdpk3mX8WZOFFvDFyhXTQMo5UipOVB0QvWynVw0kkRtZ_r1OfOcDE1";
			$id4 = "eNxiF6NW0rI:APA91bHOdDuG6TEccpHqqkR69ACTJ7QwoHD3l8s2gDfY9u8OryrBmqcsxOXmTGN8S5ibIodDXzSHmwbeRkLkUU1phqwmZhqeLJCg_Shni8R9yR4qiPOfUWQ0uO9kkiYwtUnQLnsM9_5b";
			$id5 = "dxUqldK1jw0:APA91bHXrR7sgZnRhn5mB-BVamUp-gylChAODOf6mAQFIxNayjqGwUpiI2EvGPumYpyqUnd0rlyuZ8qfiZ2lYsSOHhhOnZfnfWxnfVaOOSMvhBXZHbbz9KpDSA6sdcoTvnlmI1UKNynz";
			$id6 = "eQZ6Di6fTyM:APA91bEbPGro33m5RsFXVyc4eVIqOwIre4LyHbf17BYKtMKrnrY_j3z8Ib3JBuM3z-HDc1-jRTEy_KGJxHuqa-R0VHcsRnC-QUR5ocJaR9ByRMGtCqaNa0C_JNxsj_66vwvuMCOAZc_5"; */
			
			$fields = array(
				'registration_ids' => array("f6O5mIH3VME:APA91bEl0XbPgyCyr6mlYyEuKdPSR-Vry7wKr8ZverY0GSNMh2ga0ouzqYSOwhvnzruZib8dcLZvyAgmcAzYiAUa-V9l-To7XKLP56HENWYnDpgBoJoeLsHdCQ7q-wyW3xDzFOaaBEuM"),
				'data' => array("body"=>$message)
			);
			
			$headers = array(
				'Authorization: key=' . "API KEY", // API Key will be present in the console fcm. 
				'Content-Type: application/json'
			);
			foreach($data as $key=>$v1){
			
				$fields = array (
					'to' => $v1,
					'notification' => array (
						"body" => $message,  // Custom Message, Festival Wishes.
						"title" => "Hi All", // Title can be given based on Events ex: Happy Holi
						"icon" => "myicon"  // your website fav icon
						)
				);
			
			
			
			//Initializing curl to open a connection
			$ch = curl_init();
 
			//Setting the curl url
			curl_setopt($ch, CURLOPT_URL, $url);
			
			//setting the method as post
			curl_setopt($ch, CURLOPT_POST, true);
	 
			//adding headers 
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	 
			//disabling ssl support
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			
			
			//adding the fields in json format 
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
 
			//finally executing the curl request 
			$result = curl_exec($ch);
			echo $result."<br/>";
			
			if ($result === FALSE) {
				
				echo 'Curl failed: ' . curl_error($ch);
				
			}
 
			//Now close the connection
			curl_close($ch);
			}
		}catch (Exception $e) {
			
			echo $e->getMessage();
		}
	}
	
?>
