<?php

	$conn = mysqli_connect("192.168.11.252","root","","raberp");

	// Check connection
	if (mysqli_connect_errno())
	  {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  }
	
	
	$sql = "SELECT * FROM upazillas WHERE id > 460";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		
		while($row = mysqli_fetch_assoc($result)) {
			
			mysqli_query($conn, "UPDATE upazillas SET id = ".($row['id']-15)." WHERE id = ".$row['id']);
		}
	} else {
		echo "0 results";
	}

	mysqli_close($conn);
	
	/*INSERT INTO countries(country_name,created_at,updated_at)
	SELECT country_name,Now(),Now() FROM lib_list_country
	
	UPDATE `upazilla` SET `district`=26 WHERE `district`='Brahmanbaria'
	
	INSERT INTO upazillas(upazilla_name,district_id,created_at,updated_at)
	SELECT upazila,district,Now(),Now() FROM upazilla*/
	
	
  ?>