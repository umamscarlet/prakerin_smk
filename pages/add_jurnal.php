<?php
if (isset($_SESSION['login']) and $_SESSION['login']==1) {
	$level=$_SESSION['level'];
	
	if ($level=="superuser" || $level=="admin" || $level=="siswa") {
		$user=$_SESSION['user'];
		$x=mysql_query("select * from siswa where username='$user'");
		$y=mysql_fetch_array($x);
		$nis=$y['nis'];
?>

<div align="left" style="float: left; margin: 5px 0 0 10px;">
<!-- post content block -->
<div id="post">

<?php
	include "inc/breadcrumbs.php";
?>

<div style="margin-top: 20px;">
<div align="center"><h3>Tambah Data Jurnal Harian</h3></div>
<form enctype="multipart/form-data" name="add" method="post">
<table width="100%" border="0" cellpadding="3">
  <tr>
    <td width="22%">NIS<sup><span style="color: red;"> * </span></sup></td>
    <td width="3%" align="center">:</td>
    <td width="75%">
	<span id="sprytextfield1">
	<input name="nis" type="text" id="nis" size="10" maxlength="5" value="<?php echo $nis; ?>" disabled="disabled" />
    <span class="textfieldRequiredMsg">Mohon isi field ini!</span>	</span>	</td>
  </tr>
  <tr>
    <td>Tanggal<sup><span style="color: red;"> * </span></sup></td>
    <td align="center">:</td>
    <td>
	<span id="sprytextfield2">
	<input type="text" name="tgl" size="10" />
	<a href="javascript:void(0)" onClick="if(self.gfPop)gfPop.fPopCalendar(document.add.tgl); return false;">
	<img name="popcal" align="absmiddle" style="border:none" src="date/calender.jpeg" width="34" height="30" border="0" alt="calender.jpeg">	</a>
		
	<!--  PopCalendar(tag name and id must match) Tags should not be enclosed in tags other than the html body tag. -->
	<iframe width="100" height="200" name="gToday:normal:date/agenda.js" id="gToday:normal:date/agenda.js" src="date/ipopeng.htm" 
	scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:fixed; top:-500px; left:-500px;">	</iframe>
	<span class="textfieldRequiredMsg">Mohon isi field ini!</span></span>	</td>
  </tr>
  <tr>
    <td>Nama Kegiatan<sup><span style="color: red;"> * </span></sup></td>
    <td align="center">:</td>
    <td><span id="sprytextfield3">
	<input name="kegiatan" type="text" id="kegiatan" size="50" />
    <span class="textfieldRequiredMsg">Mohon isi field ini!</span>	</span></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td>Tulis <i>Nama Kegiatan</i> yang Anda kerjakan</td>
  </tr>
  <tr>
    <td valign="top">Uraian</td>
    <td align="center" valign="top">:</td>
    <td><textarea name="uraian" id="uraian" cols="50" rows="10"></textarea></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Tulis <i>Uraian</i> tentang kegiatan yang Anda kerjakan</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><input type="submit" name="submit" class="button-style" value="Simpan Data" /></td>
  </tr>
  <tr>
    <td colspan="3"><span style="color: red;"><sup> * </sup>Data tidak boleh kosong!</span></td>
    </tr>
  <tr>
    <td colspan="3" align="center">
	<?php
	  	$note=(isset($_GET['notif']))? $_GET['notif']: "blank";
		switch ($note) {
			case "added":
			echo "<div id='box-success'>Data berhasil disimpan<br />Klik <a href='?page=data_jurnal'>disini</a> untuk melihat</div>";
			break;
			case "blank": default:
			echo "";
		}
	?>	 </td>
    </tr>
</table>
<input type="hidden" name="tambah" value="jurnal" />
</form>
</div>
</div>
</div>

<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
bkLib.onDomLoaded(function(){
	new nicEditor({buttonList : ['link','unlink',]}).panelInstance('uraian');
});
</script>

<?php
	if (isset($_POST['tambah']) and $_POST['tambah']=="jurnal") {
		$kegiatan=$_POST['kegiatan'];
		$tgl=$_POST['tgl'];
		$uraian=$_POST['uraian'];
		
		$tambah=mysql_query("insert into jurnal_harian values('default','$nis','$tgl','$kegiatan','$uraian')");
		
		if ($tambah) {
			direct("?page=add_jurnal&notif=added");
		}
	}
	
	} else {
		echo "<br /><center>ERROR 404<br />Page Not Found!</center>";
	}
	
} else {
	lokasi("login");
}
?>