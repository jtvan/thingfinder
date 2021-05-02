<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="w3.css">
	<style>
		* { box-sizing: border-box; }
		body {
		font: 16px Arial;
		}
		.autocomplete {
		/*the container must be positioned relative:*/
		position: relative;
		display: inline-block;
		}
		input {
		border: 1px solid transparent;
		background-color: #f1f1f1;
		padding: 10px;
		font-size: 16px;
		}
		input[type=text] {
		background-color: #f1f1f1;
		width: 100%;
		}
		input[type=submit] {
		background-color: DodgerBlue;
		color: #fff;
		}
		.autocomplete-items {
		position: absolute;
		border: 1px solid #d4d4d4;
		border-bottom: none;
		border-top: none;
		z-index: 99;
		/*position the autocomplete items to be the same width as the container:*/
		top: 100%;
		left: 0;
		right: 0;
		}
		.autocomplete-items div {
		padding: 10px;
		cursor: pointer;
		background-color: #fff;
		border-bottom: 1px solid #d4d4d4;
		}
		.autocomplete-items div:hover {
		/*when hovering an item:*/
		background-color: #e9e9e9;
		}
		.autocomplete-active {
		/*when navigating through the items using the arrow keys:*/
		background-color: DodgerBlue !important;
		color: #ffffff;
		}
	</style>
</head>
<body>

	<?php
		// Initialize the session
		session_start();
		
		// Check if the user is logged in, otherwise redirect to login page
		if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || !isset($_SESSION["permission"]) || $_SESSION["permission"] != "x"){
			header("location: login.php");
			exit;
		}
	?>


	<form autocomplete="off" action="scan.php" method="post"  enctype="multipart/form-data">
		<h4>Register a new item for tracking:</h4> 
		<br>
		<label for="itemName">Name the item:</label>
		<input type="text" id="itemName" name="itemName" style="width:200px;" required>
		<br><br>
		<!--<label for="itemCate">Item Category:</label>
		<input type="text" id="itemCate" name="itemCate" required>
		<br><br> -->

		<div class="autocomplete" style="width:200px;">
			<input type="text" id="itemCate" name="itemCate" placeholder="Enter an item category" required>
		</div>
		<br><br>
				
		<button onclick="showCateList()" id="cateListButton" type="button">Show Category List</button>
		<br>
		<div id="cateList"></div>

		<script>
		function showCateList() {
			var x = document.getElementById("cateList");
			var button = document.getElementById("cateListButton");
			if (x.innerHTML === "") {
				x.innerHTML = `person, bicycle, car, motorbike, aeroplane, bus, train, truck,
							boat, traffic light, fire hydrant, stop sign, parking meter, bench,
							bird, cat, dog, horse, sheep, cow, elephant, bear, zebra, giraffe,
							backpack, umbrella, handbag, tie, suitcase, frisbee, skis, snowboard,
							sports ball, kite, baseball bat, baseball glove, skateboard, surfboard,
							tennis racket, bottle, wine glass, cup, fork, knife, spoon, bowl, banana,
							apple, sandwich, orange, broccoli, carrot, hot dog, pizza, donut, cake,
							chair, sofa, pottedplant, bed, diningtable, toilet, tvmonitor, laptop, mouse,
							remote, keyboard, cell phone, microwave, oven, toaster, sink, refrigerator,
							book, clock, vase, scissors, teddy bear, hair drier, toothbrush`;
				button.innerHTML = "Hide Category List";
			} else {
				x.innerHTML = "";
				button.innerHTML = "Show Category List";
			}
			} 
		</script>
		<!-- removed due to time constraints
		<img src="demoPictures/takeImage.jpg" alt="Live feed of system camera." width="200" height="200">
		-->
		<br>
		
		<label for="img">Select image(s):</label>
		<input type="file" id="img" name="img" accept="image/*">

		<br><br>



		

		<!-- confirm new item addition -->
		<script>
			function confirmSelection() {
			  var txt;
			  var r = confirm("Are you sure?");
			  if (r == true) {
				txt = "New item added.";
			  } else {
				txt = "You cancelled.";
			  }
			  document.getElementById("confirmResult").innerHTML = txt;
			}
		</script>
		
		<!-- autocomplete script -->
		<script>
			function autocomplete(inp, arr) {
			/*the autocomplete function takes two arguments,
			the text field element and an array of possible autocompleted values:*/
			var currentFocus;
			/*execute a function when someone writes in the text field:*/
			inp.addEventListener("input", function(e) {
				var a, b, i, val = this.value;
				/*close any already open lists of autocompleted values*/
				closeAllLists();
				if (!val) { return false;}
				currentFocus = -1;
				/*create a DIV element that will contain the items (values):*/
				a = document.createElement("DIV");
				a.setAttribute("id", this.id + "autocomplete-list");
				a.setAttribute("class", "autocomplete-items");
				/*append the DIV element as a child of the autocomplete container:*/
				this.parentNode.appendChild(a);
				/*for each item in the array...*/
				for (i = 0; i < arr.length; i++) {
					/*check if the item starts with the same letters as the text field value:*/
					if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
					/*create a DIV element for each matching element:*/
					b = document.createElement("DIV");
					/*make the matching letters bold:*/
					b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
					b.innerHTML += arr[i].substr(val.length);
					/*insert a input field that will hold the current array item's value:*/
					b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
					/*execute a function when someone clicks on the item value (DIV element):*/
						b.addEventListener("click", function(e) {
						/*insert the value for the autocomplete text field:*/
						inp.value = this.getElementsByTagName("input")[0].value;
						/*close the list of autocompleted values,
						(or any other open lists of autocompleted values:*/
						closeAllLists();
					});
					a.appendChild(b);
					}
				}
			});
			/*execute a function presses a key on the keyboard:*/
			inp.addEventListener("keydown", function(e) {
				var x = document.getElementById(this.id + "autocomplete-list");
				if (x) x = x.getElementsByTagName("div");
				if (e.keyCode == 40) {
					/*If the arrow DOWN key is pressed,
					increase the currentFocus variable:*/
					currentFocus++;
					/*and and make the current item more visible:*/
					addActive(x);
				} else if (e.keyCode == 38) { //up
					/*If the arrow UP key is pressed,
					decrease the currentFocus variable:*/
					currentFocus--;
					/*and and make the current item more visible:*/
					addActive(x);
				} else if (e.keyCode == 13) {
					/*If the ENTER key is pressed, prevent the form from being submitted,*/
					e.preventDefault();
					if (currentFocus > -1) {
					/*and simulate a click on the "active" item:*/
					if (x) x[currentFocus].click();
					}
				}
			});
			function addActive(x) {
				/*a function to classify an item as "active":*/
				if (!x) return false;
				/*start by removing the "active" class on all items:*/
				removeActive(x);
				if (currentFocus >= x.length) currentFocus = 0;
				if (currentFocus < 0) currentFocus = (x.length - 1);
				/*add class "autocomplete-active":*/
				x[currentFocus].classList.add("autocomplete-active");
			}
			function removeActive(x) {
				/*a function to remove the "active" class from all autocomplete items:*/
				for (var i = 0; i < x.length; i++) {
				x[i].classList.remove("autocomplete-active");
				}
			}
			function closeAllLists(elmnt) {
				/*close all autocomplete lists in the document,
				except the one passed as an argument:*/
				var x = document.getElementsByClassName("autocomplete-items");
				for (var i = 0; i < x.length; i++) {
				if (elmnt != x[i] && elmnt != inp) {
				x[i].parentNode.removeChild(x[i]);
				}
			}
			}
			/*execute a function when someone clicks in the document:*/
			document.addEventListener("click", function (e) {
				closeAllLists(e.target);
			});
			} 
		</script>


		<script>
		//call the autocomplete on this list of possible categories
			var categories = ["person", "bicycle", "car", "motorbike", "aeroplane", "bus", "train", "truck",
			"boat", "traffic light", "fire hydrant", "stop sign", "parking meter", "bench",
			"bird", "cat", "dog", "horse", "sheep", "cow", "elephant", "bear", "zebra", "giraffe",
			"backpack", "umbrella", "handbag", "tie", "suitcase", "frisbee", "skis", "snowboard",
			"sports ball", "kite", "baseball bat", "baseball glove", "skateboard", "surfboard",
			"tennis racket", "bottle", "wine glass", "cup", "fork", "knife", "spoon", "bowl", "banana",
			"apple", "sandwich", "orange", "broccoli", "carrot", "hot dog", "pizza", "donut", "cake",
			"chair", "sofa", "pottedplant", "bed", "diningtable", "toilet", "tvmonitor", "laptop", "mouse",
			"remote", "keyboard", "cell phone", "microwave", "oven", "toaster", "sink", "refrigerator",
			"book", "clock", "vase", "scissors", "teddy bear", "hair drier", "toothbrush"];

			autocomplete(document.getElementById("itemCate"), categories);
		</script>


		<p1 id="confirmResult"></p1><br>
		

		<button onclick="confirmSelection()" name="submit" type="submit">Finalize New Item</button>
	</form>

	<form action="startScreen.php" method="get">
		<button type="submit">Back</button>
	</form>
		
</body>
</html>
