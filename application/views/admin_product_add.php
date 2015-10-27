<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Create a new product</title>
</head>
<body>
	<form action='/products/create' method='post'>
    	Name: <input type='text' name='name'>
    	Description: <textarea name='description'></textarea>
    	Price: <input type='text' name='price'>
    	<input type='submit' value='Add Product'>
    </form>
</body>
</html>