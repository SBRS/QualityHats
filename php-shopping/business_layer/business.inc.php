 <?php
// Include MySQL class
require_once("/php-shopping/data_layer/data.inc.php");

class Business {
	
	public static function showCart()
	{
		global $db;
		$cart = $_SESSION['cart'];
		if ($cart)
		{
			$items = explode(',',$cart);
			$contents = array();
			$total = 0;
			
			foreach ($items as $item)
			{
				$contents[$item] = (isset($contents[$item])) ? $contents[$item] + 1 : 1;
			}
			
			$output[] = '<div class="row">
							<div class="col-sm-1">
								<h4 class="display-4">Hat ID</h4>
							</div>
							<div class="col-sm-2">
								<h4 class="display-4">Hat</h4>
							</div>
							<div class="col-sm-2">
								<h4 class="display-4">Hat Category</h4>
							</div>
							<div class="col-sm-2">
								<h4 class="display-4">Quantity</h4>
							</div>
							<div class="col-sm-1">
								<h4 class="display-4">Price</h4>
							</div>
						</div>';
			$output[] = '<form action="index.php?content_page=Hats&action=update" method="post">';
			
			foreach ($contents as $id=>$qty)
			{
				$sql = 'SELECT * FROM hat, category WHERE HatId = '.$id.' AND category.CategoryId = hat.CategoryId';
				$result = $db->query($sql);
				$row = $result->fetch();
				extract($row);
				$output[] = '<div class="row">';
				$output[] = '<div class="col-sm-1">'.$HatId.'</div>';
				$output[] = '<div class="col-sm-2">'.$HatName.'</div>';
				$output[] = '<div class="col-sm-2">'.$CategoryName.'</div>';
				$output[] = '<div class="col-sm-2"><input type="text" name="qty'.$id.'" value="'.$qty.'" size="3" maxlength="3" /></div>';
				$output[] = '<div class="col-sm-1">$NZ '.$UnitPrice.'</div>';
				$output[] = '<div class="col-sm-2"><a href="index.php?content_page=Hats&action=delete&id='.$id.'"><button class="btn btn-danger">Remove</button></a></div>';
				$output[] = '</div>';
				$subtotal += $UnitPrice * $qty;
			}
			
			$gst = $subtotal * 0.15;
			$grandtotal = $gst + $subtotal;
			$output[] = '<div class="row">
								<div class="col-sm-5"></div>
								<div class="col-sm-2">Subtotal:</div>
								<div class="col-sm-2"><strong>$NZ '.$subtotal.'</strong></div>
						 </div>';
			$output[] = '<div class="row">
								<div class="col-sm-5"><button type="submit" class="btn btn-warning">Update cart</button></div>
								<div class="col-sm-2">GST:</div>
								<div class="col-sm-2"><strong>$NZ '.$gst.'</strong></div>
						 </div>';
			$output[] = '<div class="row">
								<div class="col-sm-5"></div>
								<div class="col-sm-2">Grand Total:</div>
								<div class="col-sm-2"><strong>$NZ '.$grandtotal.'</strong></div>
						 </div>';
			$output[] = '</form>';
			$output[] = '<div class="row">
								<div class="col-sm-1"><a href="index.php?content_page=Hats&action=delete_all"><button class="btn btn-danger">Clear Cart</button></a></div>
								<div class="col-sm-1"><a href="index.php?content_page=OrderCreate"><button class="btn btn-success">Create Order</button></a></div>
						 </div>';
			$_SESSION['subtotal'] = $subtotal;
		}
		else
		{
			$output[] = '<p>Your shopping cart is empty.</p>';
		}
		return join('',$output);
	}
	
	public static function processActions()
	{
		if (isset($_SESSION['cart']))
		{
			$cart = $_SESSION['cart'];
		}

		if (isset($_GET['action']))
		{
			$action = $_GET['action'];
		}
		
		switch ($action)
		{
			case 'add':
				if (isset($cart) && $cart!='')
				{
					$cart .= ','.$_GET['id'];
				}
				else
				{
					$cart = $_GET['id'];
				}
				break;
			case 'delete':
				if ($cart)
				{
					$items = explode(',',$cart);
					$newcart = '';
					foreach ($items as $item)
					{
						if ($_GET['id'] != $item)
						{
							if ($newcart != '')
							{
								$newcart .= ','.$item;
							}
							else 
							{
								$newcart = $item;
							}
						}
					}
					$cart = $newcart;
				}
				break;
			case 'delete_all':
				if ($cart)
				{
					$cart = '';
				}
				break;
			case 'update':
				if ($cart)
				{
					$newcart = '';
					foreach ($_POST as $key=>$value)
					{
						if (stristr($key,'qty'))
						{
							$id = str_replace('qty','',$key);
							$items = ($newcart != '') ? explode(',',$newcart) : explode(',',$cart);
							$newcart = '';
							foreach ($items as $item)
							{
								if ($id != $item)
								{
									if ($newcart != '')
									{
										$newcart .= ','.$item;
									}
									else
									{
										$newcart = $item;
									}
								}
							}
							for ($i=1;$i<=$value;$i++)
							{
								if ($newcart != '') 
								{
									$newcart .= ','.$id;
								}
								else 
								{
									$newcart = $id;
								}
							}
						}
					}
				}
				$cart = $newcart;
				break;
		}
		$_SESSION['cart'] = $cart;
	}
}
?>