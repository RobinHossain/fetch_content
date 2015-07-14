<!DOCTYPE html>
<html lang="en">
	<head>
		
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title></title>
		
		<link href="bootstrap.min.css" rel="stylesheet">
		<style>
			.title{
				font-size: 1.1em;
				  line-height: 1;
				  font-weight: bold;
				  float: left;
				  padding: 0 5px;
			}
			.title span{
				font-size: 0.98em;
			}
			.product_spec, .product_overview, .product_title, .product_brand,.link_structure{
				width: 99.99%;
				margin: 0 auto;
				float: left;
				clear: both;
				padding: 5px 0;
			}
		</style>
		<!--<script src="jquery-1.11.3.min.js"></script> -->
	</head>
	<body>
		
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-lg-12">
					<form>
						<div class="form-group">
							<label for="exampleInputEmail1">Your Website URL</label>
							<input type="text" class="form-control" name="geturl" id="exampleInputEmail1" placeholder="Please input your website url to get specify content">
						</div>
						<button type="submit" class="btn btn-default">Submit</button>
					</form>
				</div>
			</div>
		</div>
		<div class="container">
		<div class="row">
				<div class="col-xs-12 col-sm-12 col-lg-12">
	
<?php
header('Content-Type: text/html; charset=utf-8');
	$servername = "localhost"; $username = "fixitcom_homedep"; $password = "Admin.2015"; $dbname = "fixitcom_homedepot2";
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error);}
	if(isset($_GET['geturl'])){
		$url = $_GET['geturl']; }
		if(!empty($url)){
		$html = file_get_contents($url);
		$htmls = mb_convert_encoding($html, 'HTML-ENTITIES', "UTF-8");
		$doc = new DOMDocument();
		$doc->strictErrorChecking = false;
		$doc->recover=true;
		//echo $htmls;
		@$doc->loadHTML("<html><head><meta charset='UTF-8'></head><body>".$htmls."</body></html>");
		
		
		$xpath = new DOMXpath($doc);
		//$description = $xpath->query("//*/div[@class='main_description']");
		
		//$product_description = $xpath->query("//*/div[contains(@id, 'product_description')]");
		//$model_no = $xpath->query("//*/span[@itemprop='model']");
		//$breadcrumbs = $xpath->query("//*/ul li[@id='breadcrumb']");
		
		//echo "[". $element->nodeName. "]";
				//$nodes = $element->childNodes;
				// foreach ($nodes as $node) {
				// 	$cont2 = $node->nodeValue;
				// 	echo $cont2;
				// }
		
		//$breadcrumbs = $xpath->query("//div[@id='row2']//li/a/text()");
		$breadcrumbs = $xpath->query("//ul[@id='header-crumb']");
		
		
		
		$product_titles = $xpath->query("//*/h1[@class='product_title']");
		$product_brand = $xpath->query("//*[@id='productinfo_ctn']/div[1]/div/div[1]/div[2]/div/h2[1]/span");
		//$product_descriptions = $xpath->query("//*/div[@id='product_description']");
		$product_descriptions = $xpath->query("//*/div[@id='product_description']/div/div[2]");
		$specifi_dimensions = $xpath->query("//*[@id='specsContainer']/table[1]");
		$specifi_details = $xpath->query("//*[@id='specsContainer']/table[2]");
		
		$specifi_scripts = $xpath->query("//*[@id='productinfo_ctn']/div[1]/div/div[4]/div/script/child::text()");
		
		
		
		
		if (!is_null($specifi_scripts)) {
			foreach ($specifi_scripts as $specifi_script) {
				echo "<hr><div class='link_structure'><div class='title'>Link Structure :</div>";
					$script_1 = $specifi_script->nodeValue;
			}
		
		//$freplace=array('<li>','</li>','\n', 'a');
		//$script_2 = str_replace($freplace, ' ', $script_1);
		$doc = new DOMDocument();
		$doc->strictErrorChecking = false;
		$doc->recover=true;
		@$doc->loadHTML("<html><body><div>".$script_1."</div></body></html>");
		
		$xpath2 = new DOMXpath($doc);
		$script_2 = $xpath2->query("/html/body/div[1]/li[1]");
		
		
		
		if (!is_null($script_2)) {
			foreach ($script_2 as $script_2s) {
				$script_3 = $script_2s->nodeValue;
			}
		}
		
		
		
		
		
		$script_4 = str_replace('\n', '<br>', $script_3);
		$script_5 = str_replace('","', '<br>', $script_4);
		
		$script_6 = str_replace('<br>        <br>        <br>', ' -> ', $script_5);
		$script_7 = str_replace('<br>', ' ', $script_6);
		$script_9 = substr($script_7, 0, strpos( $script_7, 'bcEnsightenData'));
		//$script_9 = preg_replace('/\s+/', '', $script_8);
		
			
		echo $script_9;
		echo "</div>";
		}
		
		
		if (!is_null($product_titles)) {
			foreach ($product_titles as $product_title) {
				
				echo "<br><div class='product_title'><div class='title'>Product Title:</div>" ;
				$print_title = $product_title->nodeValue;
				echo $print_title;
				echo "</div>";
			}
		}
		
		if ($product_brand->length > 0) {
				$pb2 = $product_brand->item(0)->nodeValue;
				echo "<br><div class='product_brand'><div class='title'>Product Brand:</div>";
				$pb=preg_replace('/\s+/', '', $pb2);
				echo $pb."</div>";
			}
		echo "<br><div class='product_overview'><div class='title'>Product Overview:</div>";
		if (!is_null($product_descriptions)) {
			foreach ($product_descriptions as $product_descriptionss) {
					$desc_conss = $product_descriptionss->nodeValue;
					$desc_cons = str_replace("'", "", $desc_conss);
					echo $desc_cons;
					echo "</div>";
			}
		}
		
		echo "<br><div class='product_spec'><div class='title'>Product Specification</div><br>";
		if (!is_null($specifi_dimensions)) {
			foreach ($specifi_dimensions as $specifi_dimensio) {
				echo "<div class='dimensions'><div class='title'><span>Dimensions :</span></div>";
					echo $specifi_dimension = $specifi_dimensio->nodeValue;
					echo "</div>";
			}
		}
		if (!is_null($specifi_details)) {
			foreach ($specifi_details as $specifi_detai) {
			
				echo "<div class='product_details'><div class='title'><span>Product Details :</span></div>";
				//echo $specifi_detai->nodeName;
				
					$specifi_detail1= $specifi_detai ->nodeValue;
					
					//$a = html_entity_decode('>&nbsp;<');
					//$specifi_detail= str_replace('\xA0', '', $specifi_detail1);
					$specifi_detail= html_entity_decode($specifi_detail1); 
					
					echo $specifi_detail;
					
					
					
					echo "</div></div>";
			}
			
			//$sql = "INSERT INTO `getcontent`.`content` (`id`, `website`, `link_structure`, `product_name`, `brand`, `product_overview`, `product_dimensions`, `product_details`) VALUES (NULL, '".$url."', '".$script_7."', '".$print_title."', '".$pb."', '".$desc_con."', '".$specifi_dimension."', '".$specifi_detail."')";
			
		}
		
			$sql ="INSERT INTO  `fixitcom_homedepot2`.`content` ( `id` , `website` , `link_structure` , `product_name` , `brand` , `product_overview` , `product_dimensions` , `product_details` ) VALUES ( NULL ,  '".$url."',  '".$script_9."',  '".$print_title."',  '".$pb."',   '".$desc_cons."',  '".$specifi_dimension."',  '".$specifi_detail."' )"; 
			//$sql. ="UPDATE fixitcom_homedepot2.content set product_overview= replace (product_overview,'Â',''), product_dimensions= replace (product_dimensions,'Â',''), product_details = replace (product_details,'Â','')";
			
			
			
			
				echo "<div class='clearfix'></div>";
				 if ($conn->query($sql) === TRUE) { echo "<hr><div class='alert alert-success center' role='alert'>Website content has been saved.</div>"; } 
				 else { echo "Error: " . $sql . "<br>" . $conn->error; }
		
	}
?>

<a href="http://fixit.com.bd/homedepot/get.php"><div class="btn btn-default btn-lg">Download List as CSV</div></a>
	
<div class='clearfix'></div>



</div></div></div>
</body>
</html>
