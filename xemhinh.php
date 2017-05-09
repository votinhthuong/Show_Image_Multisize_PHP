<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="" enctype="multipart/form-data">
  <table width="700" border="1" align="center" cellpadding="1" cellspacing="1">
    <tr>
      <td width="196">Hình ảnh</td>
      <td width="491"><label for="select"></label>
        <select name="hinh" id="hinh">
        <?php
			$path= opendir("hinh_anh"); //Tìm đến thư mục chứa hình ảnh và lấy ra các thư mục trong nó, ở đây là các thư mục con của folder hinh_anh
			if($path){
				while(($file=readdir($path)) !== false) //Duyệt các folder có trong thư mục hinh_anh
				{
					if(strstr($file,".") == false) //Kiểm tra xem phải là folder hay không. Nếu là file sẽ có dấu chấm ngăn cách tên và extension
					{
						//Đổ các tên folder vào các tuỳ chọn của List Menu
						echo "<option value='$file'";
						if(!empty($_POST['hinh'])){
							if($_POST['hinh']==$file) echo "selected='selected'";
						}
						echo ">$file</option>";
					}
				}
				closedir($path);
			}
		?>
      </select></td>
    </tr>
    <tr>
      <td>Size</td>
      <td><select name="size" id="size">
        <option value="50"<?php if(!empty($_POST['size'])) {if($_POST['size']==50) echo "selected='selected'";} ?>>50x50</option>
        <option value="100"<?php if(!empty($_POST['size'])) {if($_POST['size'] == 100) echo "selected ='selected'";} ?>>100x100</option>
        <option value="150"<?php if(!empty($_POST['size'])) {if($_POST['size'] == 150) echo "selected ='selected'";}?>>150x150</option>
        <option value="200"<?php if(!empty($_POST['size'])) {if($_POST['size'] == 200) echo "selected ='selected'";}?>>200x200</option>
      </select></td>
    </tr>
    <tr>
      <td colspan="2" align="center" valign="middle"><input type="submit" name="show" id="show" value="SHOW" /></td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
  </table>
</form>
<?php
if(isset($_POST['show'])){
	//Tạo mảng chứa các extension thông dụng của hình ảnh 
	$filetype = array(".gif", ".GIF", ".jpg", ".JPG", ".JPEG", ".png", ".PNG", ".jpeg");
	//if(!empty($_POST['hinh'])){
		$ten_thumuc= "hinh_anh/".$_POST['hinh'];
	//}
	//if(!empty($_POST['size'])){
		$size= $_POST['size'];
	//}
	//if(isset($_POST['hinh'])){
		$path2= opendir($ten_thumuc);
	//}
	echo "<table align='center' width='650'><tr>";
	if($path2)
	{
		while(($file=readdir($path2)) !== false)
		{
			if($file != "." && $file != "..")
			{
				$duoi_file = strstr($file,'.');
				if(in_array($duoi_file,$filetype))
				{
					$ten_file = $ten_thumuc."/".$file;
					echo "<img src='$ten_file' width='$size' height='$size' border='1' alt='$file'>";
				}
			}
		}
		closedir($path2);
	}
	echo "</tr></table>";
}
?>
</body>
</html>