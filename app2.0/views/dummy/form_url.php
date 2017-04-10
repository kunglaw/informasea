<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
	<div>url : <span><?=$url?></span> </div>
	<form method="post" action="<?=base_url("test/test_url")?>">
    	<select name="huruf">
        	<option value="">- huruf -</option>
        	<option value="abc">abc</option>
            <option value="abc">abc</option>
            <option value="abc">abc</option>
        </select>
        
        <select name="angka">
        	<option value="">- angka -</option>
        	<option value="123">123</option>
            <option value="123">123</option>
            <option value="123">123</option>
        </select>
        <input type="hidden" value="search" name="search" />
        <input type="submit" value="submit"/>
    
    </form>
</body>
</html>