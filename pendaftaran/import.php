<?php
try {
		$db = new PDO ("mysql:host=localhost;dbname=import","root","");
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (Exception $e) {
		echo "Connectioon Failed ".$e->getMessage();
	}

require "exel_reader.php";
if(isset($_POST['submit'])){
	$target = basename ($_FILES['filepesertaall']['name']);
	move_uploaded_file($_FILES['filepesertaall']['tmp_name'],$target);
	$data = new Spreadsheet_Excel_Reader($_FILES['filepesertaall']['name'],false);
	$baris = $data->rowcount($sheet_index=0);
	$drop = isset($_POST["drop"])?$_POST["drop"]: 0 ;
	if($drop == 1){
	$truncate = "TRUNCATE TABLE peserta";
	mysql_query($truncate);
	};

	for ($i=2; $i <=$baris;$i++)
	{
	$nama = $data->val($i, 1);
	$tempat_lahir = $data->val($i, 2);
	$tanggal_lahir = $data->val($i, 3);
	$query = $db->prepare("INSERT into peserta (nama,tempat_lahir,tanggal_lahir) values (?,?,?)");
	$array = array($nama,$tempat_lahir,$tanggal_lahir);
	$query->execute($array);
	// $hasil = mysql_query($query);
	}

	if(!$query){
	die(mysql_error());
	} else {
	echo "Data berhasil diimpor.";
	}
	unlink($_FILES['filepesertaall']['name']);
	}
	?>
	<form name="myForm" id="myForm" onSubmit="return validateForm()" action="import.php" method ="post" enctype="multipart/form-data">
	<input type="file" id="filepesertaall" name="filepesertaall" />
	<input type="submit" name="submit" value="import"/><br/>
	<label><input type="checkbox" name="drop" value="1" /><u> Kosongkan tabel sql terlebih dahulu.</u></label>
	</form>

	<script type="text/javascript">
	function validateForm()
	{
	function hasExtension(inputID, exts){
	var fileName = document.getElementByld(inputID). value;
	return (new RegExp('(+exts.join('|').replace(/\./g,'\\.')+')).test(fileName);
	}
	if(!hasExtension ('filepesertaall',[.xls])){
	alert("Hanya file XLS (Excel 2003) yang diijinkan.");
	return false;
	}
}
</script>