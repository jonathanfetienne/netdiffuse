<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>NetDiffuse - Stock Market Tracker</title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<link href="css/style.css" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

<!--[if IE]>
      	<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  	<![endif]-->
<link href='//fonts.googleapis.com/css?family=Source+Sans+Pro:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
</head>
<!-- check to see if user has searched for a symbol -->
<?php if(isset($_POST['symbol'])) { ?>
    <body class="php">
        <div class="container">
            <div class="card">
            
                <div id="right">
                <span class="category">DATA VIZ.</span><br><span class="category-financial">Financial</span>
                </div>
                <div id="left"><span class="title-heading"><b>N</b>et<b>D</b>iffuse</span>
                <br>
                <span class="title-subheading"> Stock Market Tracker</span>
                </div>
                
                <div class="content">
                <div class="section group">
	                <div class="col span_1_of_2">

                        <?php 
                        
                        // Display information about the symbol
                        
                        $symbol = $_POST['symbol'];
                        
                        // From Yahoo Developer Network
                        // Using Yahoo API to communicate with the stock market
                        // http://query.yahooapis.com/
                        
                        $json_finance_data = file_get_contents("http://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20yahoo.finance.quotes%20where%20symbol%20in%20(%22$symbol%22)%0A%09%09&env=http%3A%2F%2Fdatatables.org%2Falltables.env&format=json"
                        );
                        
                        
                        $finance_array = json_decode($json_finance_data, true);
                        
                        echo "<h3><b> Symbol: </b>";
                        echo $finance_array["query"]["results"]["quote"]["symbol"];
                        echo "</h3>";
                        
                        echo "<h3><b> Ask price: </b>";
                        echo $finance_array["query"]["results"]["quote"]["Ask"];
                        echo "</h3>";
                        
                        echo "<h3><b>Bid price: </b>";
                        echo $finance_array["query"]["results"]["quote"]["Bid"];
                        echo "</h3>";
                        
                        echo "<h3><b>Average Daily Volume: </b>";
                        echo $finance_array["query"]["results"]["quote"]["AverageDailyVolume"];
                        echo "</h3>";
                        
                        
                        echo "<h3><b>Volume: </b>";
                        echo $finance_array["query"]["results"]["quote"]["Volume"];
                        echo "</h3>";
                        
                        ?>
                
                	</div>
                	
	                <div class="col span_1_of_2">
	                <br>
	                <form method="post" action="email.php">
	                <input type="hidden" value=<?php echo $symbol ?>>
	                <input type="email" name="email" placeholder="Please enter your email">
	                   <button type="submit" name="track" class="btn-track"><i class="fa fa-plus"></i>&nbsp;Track this symbol</button>
	                   </form>
	                   
	         
	                </div>
                </div>
            </div>
        </div>
        
        <?php 
       // Redirect user to the home page
            } else {
            header("Location: /");
        }
        ?>
    </body>
</html>
