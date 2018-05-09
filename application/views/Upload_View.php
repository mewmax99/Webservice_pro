<!DOCTYPE html>
<html>
<head>
	<title>Upload</title>
</head>
<body>

	<form action="<?php base_url();?>/Barry/Upload" method="post" enctype="multipart/form-data">
        <input placeholder="re_name"  name="re_name" type="text" /><br />
        <input placeholder="re_ingre"  name="re_ingre" type="text" /><br />
        <input placeholder="re_solu"  name="re_solu" type="text" /><br />
        <input name="images" type="file">
        <input type="submit" name="submit">

	</form>

</body>
</html>