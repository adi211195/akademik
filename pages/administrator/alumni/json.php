<?php
include "../../../config/connection.php";

        /*Menagkap semua data yang dikirimkan oleh client*/

		/*Sebagai token yang yang dikrimkan oleh client, dan nantinya akan
		server kirimkan balik. Gunanya untuk memastikan bahwa user mengklik paging
		sesuai dengan urutan yang sebenarnya */
		@$draw=$_REQUEST['draw'];

		/*Jumlah baris yang akan ditampilkan pada setiap page*/
		@$length=$_REQUEST['length'];

		/*Offset yang akan digunakan untuk memberitahu database
		dari baris mana data yang harus ditampilkan untuk masing masing page
		*/
		@$start=$_REQUEST['start'];

		/*Keyword yang diketikan oleh user pada field pencarian*/
		@$search=$_REQUEST['search']["value"];


        $data=mysqli_query($connect, "SELECT * FROM master_alumni");
                                          
		/*Menghitung total desa didalam database*/
		$total=mysqli_num_rows($data);

		/*Mempersiapkan array tempat kita akan menampung semua data
		yang nantinya akan server kirimkan ke client*/
		$output=array();

		/*Token yang dikrimkan client, akan dikirim balik ke client*/
		$output['draw']=$draw;

		/*
		$output['recordsTotal'] adalah total data sebelum difilter
		$output['recordsFiltered'] adalah total data ketika difilter
		Biasanya kedua duanya bernilai sama, maka kita assignment 
		keduaduanya dengan nilai dari $total
		*/
		$output['recordsTotal']=$output['recordsFiltered']=$total;

		/*disini nantinya akan memuat data yang akan kita tampilkan 
		pada table client*/
		$output['data']=array();

        $sql="";
		/*Jika $search mengandung nilai, berarti user sedang telah 
		memasukan keyword didalam filed pencarian*/
		if($search!=""){
		$sql.="WHERE master_alumni.alumni_npm LIKE '%$search%'";
		$sql.="OR master_alumni.alumni_name LIKE '%$search%'";
		}


		/*Lanjutkan pencarian ke database*/
		$data=mysqli_query($connect, "SELECT * FROM master_alumni $sql order by alumni_npm asc ");
		


		/*Ketika dalam mode pencarian, berarti kita harus mengatur kembali nilai 
		dari 'recordsTotal' dan 'recordsFiltered' sesuai dengan jumlah baris
		yang mengandung keyword tertentu
		*/
		if($search!=""){
		$sql2="WHERE master_alumni.alumni_npm LIKE '%$search%'";
		$sql2.="OR master_alumni.alumni_name LIKE '%$search%'";
		$data2=mysqli_query($connect, "SELECT * FROM master_alumni $sql2 order by alumni_npm asc limit $start, $length");
                                          
		$output['recordsTotal']=$output['recordsFiltered']=mysqli_num_rows($data2);
		}


		$nomor_urut=$start+1;
		while ($query=mysqli_fetch_array($data)) {
			$output['data'][]=array($nomor_urut,
			                        $query['alumni_npm'],
			                        $query['alumni_name'],
			                        $query['alumni_email'],
			                        $query['alumni_block'],
			                    	$query['alumni_sk_yudisium'],
			                    	$query['alumni_id']);
			$nomor_urut++;
		}

		echo json_encode($output);
		
?>

