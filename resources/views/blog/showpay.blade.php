<html>
	  <head>
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
	    <script type="text/javascript"
	      src="https://app.midtrans.com/snap/snap.js"
	      data-client-key="SET_YOUR_CLIENT_KEY_HERE"></script>
	    <!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->
	  </head>

	  <body>
      {{-- {{$token}}
	    <button id="pay-button">Pay!</button> --}}

			<script type="text/javascript">
			 // For example trigger on button clicked, or any time you need
			 // var payButton = document.getElementById('pay-button');
			 // payButton.addEventListener('click', function () {
				 // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
				 window.snap.pay('{{$token}}', {
					 onSuccess: function(result){
						 /* You may add your own implementation here */
						 alert("payment success!"); console.log(result);
						  window.location.href = "{{route('blog.keranjang.index')}}"
					 },
					 onPending: function(result){
						 /* You may add your own implementation here */
						 alert("wating your payment!"); console.log(result);
						 window.location.href = "{{route('blog.keranjang.index')}}"
					 },
					 onError: function(result){
						 /* You may add your own implementation here */
						 alert("payment failed!"); console.log(result);
						 window.location.href = "{{route('blog.keranjang.index')}}"
					 },
					 onClose: function(){
						 // alert('you closed the popup without finishing the payment');
						 window.location.href = "{{route('blog.keranjang.index')}}"
					 }
				 })
			 // });
		 </script>
	  </body>
	</html>
