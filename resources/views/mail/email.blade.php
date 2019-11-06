<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Email Activation</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta name="author" content="Ahmad Ardiansyah - ardiansyah3ber@gmail.com"/>
</head>
<body style="margin: 0; padding: 0;">
 <table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #e9e9e9;">
  <tr>
   <td style="margin-top: 10px;">

    <table border="0" align="center" cellpadding="0" cellspacing="0" width="600" style="margin-top: 20px; margin-bottom: 20px; ">
		 <tr>
		  <td>
		  	<div style="border-top-right-radius: 5px; border-top-left-radius: 5px; border: 1px solid #e9e9e9; padding: 10px; background-color: red; color: white;">
		   		<h2>PinjamAja</h2>
		 		</div>
		  </td>
		 </tr>
		 <tr>

		  <td bgcolor="#ffffff" style="padding: 20px 10px 20px 10px;">
			 <table border="0" cellpadding="0" cellspacing="0" width="100%">
			  <tr>
			   <td style="padding: 5px;">
			    Hello, <b>{{ $email }}</b>
			   </td>
			  </tr>
			  <tr>
			   <td style="padding: 5px;">
			    Thank you for registering on eFlats.com with your account. To finally activate your account please click the following link.
			    <br>
			    <div style="margin: 5px;">
			    	Your Token : {{ $body }}
			    </div>
			   </td>
			  </tr>
			 </table>
			</td>

		 </tr>
		 <tr>
		  <td style="margin: 5px">
		  	<div style="border-bottom-right-radius: 5px; border-bottom-left-radius: 5px; border: 1px solid #e9e9e9; padding: 10px; background-color: red; color: white;">
			  	Copyright © 2019 PinjamAja<br>
			   	Jl. Kutisari, No. 34 Sukolilo, Surabaya <br>
			   	Indonesia
		   	</div>
		  </td>
		 </tr>
		</table>

   </td>
  </tr>
 </table>
</body>
</html>