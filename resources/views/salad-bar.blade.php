<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
 
  <style>
  @page { margin-top: 100px; margin-bottom: 60px}
    header { position: fixed; left: 0px; top: -90px; right: 0px;  text-align: center; }
    #footer { position: fixed; left: 42px; bottom: -0px; right: 0px;  }
	.new_page img{
		width: 177px;
	}
    
  </style>
  
</head>
<body  style="padding: 1rem" >

<script type="text/php">
    if ( isset($pdf) ) {
        $y = $pdf->get_height() - 24;
        $x = $pdf->get_width() - 100;
        $pdf->page_text($x, $y, "Page: {PAGE_NUM} of {PAGE_COUNT}", '', 12, array(0,0,0));
    }
</script> 

<header style="text-align: center;">
        <img src="{{ global_asset('images/pdf-logo.png') }}" width="241"  height="auto" alt="" style="image-rendering: -moz-crisp-edges; image-rendering: -o-crisp-edges; image-rendering: -webkit-optimize-contrast; image-rendering: optimizeQuality; -ms-interpolation-mode: bicubic;">
    </header>
 
	<footer id="footer" style="font-family: Arial, Helvetica, sans-serif; font-size: 14px; line-height: 18px;">
        <p>*Please follow suggested serving sizes to ensure that all vegetable sub-group requirements are being met for the week<br>
        **Need to specify the specific ingredient used</p>
    </footer>


	<div style="font-family: Arial, Helvetica, sans-serif; font-size: 14px; line-height: 18px;">        
        <p style="margin: 5px 0 15px; padding: 0; font-weight: 700; font-size: 14px; text-align: center;">DAILY VEGETABLE & FRUIT BAR FOOD PRODUCTION RECORD</p>
        <table style="width:520px; margin: auto;" cellpadding="5" cellspacing="0">
            <tr>
                <td style="font-size: 12px; line-height: 18px; text-align: right; white-space: nowrap; font-weight: 400;">Site Name:</td> 
                <td style="font-size: 12px; line-height: 18px; width: 100%;">{{ $siteName }}</td>
            </tr>
            <tr>
                <td style="font-size: 12px; line-height: 18px; text-align: right; white-space: nowrap; font-weight: 400;">Date:</td> 
                <td style="font-size: 12px; line-height: 18px; width: 100%;">{{ $curent_date }}</td>
            </tr>
        </table>
        
        <table style="width: 100%; font-size: 12px; border: 2px solid #000; border-collapse: collapse;" cellpadding="1" cellspacing="0">
            <thead style="text-align: center; font-weight: 400;">
                <tr>
                    <th style="border: 2px solid #000; line-height: 12px;">Recipes & Ingredients</th>
                    <th style="border: 2px solid #000; line-height: 12px;">Serving<br>Size</th>
                    <th style="border: 2px solid #000; line-height: 12px;">Qty of<br>Food Used</th>
                    <th style="border: 2px solid #000; line-height: 12px;">Planned<br>Reimbursable</th>
                    <th style="border: 2px solid #000; line-height: 12px;">Planned<br>A la Carte</th>
                    <th style="border: 2px solid #000; line-height: 12px;">Planned Total</th>
                    <th style="border: 2px solid #000; line-height: 12px;">Actual # of<br>Meals Served</th>
                    <th style="border: 2px solid #000; line-height: 12px;"># of Meals<br>Over/Under</th>
                    <th style="border: 2px solid #000; line-height: 12px;">Temp. after<br>Preperation</th>
                    <th style="border: 2px solid #000; line-height: 12px;">Time Temp.<br>was Taken</th>
                    <th style="border: 2px solid #000; line-height: 12px;">Initials</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="text-align: center; font-weight: 700; text-decoration: underline;border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">Dark Green - 1/8 Cup*</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">Broccoli</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">Loose Lettuce (Bibb, Boston, Spring Mix)</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">Romaine</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">Spinach</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">Kale</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">Bok Choy</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">Other **</td>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">&nbsp;</td>
                </tr>
    
                <tr>
                    <td style="text-align: center; font-weight: 700; text-decoration: underline;border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">Red / Orange - 1/4 Cup*</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">Baby Carrots</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">Carrots</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">Red Peppers</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">Sweet Potatoes</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">Cherry Tomatoes</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">Pumpkin</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                </tr>            
                <tr>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">Diced Tomatoes</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">Other **</td>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">&nbsp;</td>
                </tr>
    
                <tr>
                    <td style="text-align: center; font-weight: 700; text-decoration: underline;border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">Starchy - 1/8 Cup*</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">Corn</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">Green Peas</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">Jicama</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">Potatoes</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">Other **</td>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">&nbsp;</td>
                </tr>
    
                <tr style="page-break-before: always;">
                    <td style="text-align: center; font-weight: 700; text-decoration: underline;border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">Legumes - 1/8 Cup*</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">Baked Beans</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">Black Beans</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">Garbanzo Beans</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">Kidney Beans</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">Pinto Beans</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">Edamame</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">Other **</td>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">&nbsp;</td>
                </tr>
    
                <tr>
                    <td style="text-align: center; font-weight: 700; text-decoration: underline;border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">Other - 1/8 Cup*</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">Cabbage</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">Celery Sticks</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">Cucumbers</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">Diced Celery</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">Green Beans</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">Shredded Lettuce</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">Cauliflower</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">Diced Onions</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">Sugar Snap Peas</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">Radishes</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">Beets</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">Mushrooms</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">Avocado</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                </tr>            
                <tr>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">Zucchini</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">Other **</td>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">&nbsp;</td>
                </tr>
    
                <tr>
                    <td style="text-align: center; font-weight: 700; text-decoration: underline;border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">Additional - <br><br>1/4 Cup (K-8)* or 1/2 Cup (9-12)*</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">Choose item(s) from the above subgroups</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">Other **</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">Other **</td>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">&nbsp;</td>
                </tr>
    
                <tr style="page-break-before: always;">
                    <td style="text-align: center; font-weight: 700; text-decoration: underline;border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">Fruit - 1/2 Cup*</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">Fresh Apple</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">Fresh Banana</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">Fresh Grapes</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">Fresh Kiwi</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">Fresh Orange</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">Fresh Pear</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">Fresh Strawberries</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">Fresh Watermelon</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">Fruit Cocktail</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                </tr>            
                <tr>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">Mandarin Oranges</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                </tr>            
                <tr>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">Peach Cup</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                </tr>            
                <tr>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">Chilled Peaches</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                </tr>            
                <tr>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">Chilled Pears</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                </tr>            
                <tr>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">Chilled Pineapple</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                </tr>            
                <tr>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">Strawberry Cup</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                </tr>            
                <tr>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">Applesauce Cup**</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                </tr>            
                <tr>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">Fruit Juice **</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                </tr>            
                <tr>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">Raisin Box</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">Other **</td>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">&nbsp;</td>
                </tr>
    
                <tr>
                    <td style="text-align: center; font-weight: 700; text-decoration: underline;border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">Toppings - 1 Tbsp*</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">Croutons</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">Sunflower Seeds</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">Almonds</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">Pumpkin Seeds</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">Parmesan Cheese</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 1px dotted #ccc; line-height: 12px;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">Other **</td>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">&nbsp;</td>
                    <td style="border-right: 2px solid #000; border-bottom: 2px solid #000; line-height: 12px;">&nbsp;</td>
                </tr>
            </tbody>
        </table>
    </div>

</body>
</html>