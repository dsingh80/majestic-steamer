<?php 

date_default_timezone_set('Etc/UTC');

require './assets/vendor/PHPMailer/PHPMailerAutoload.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){

	//print_r($_POST);
	
	$NAME = htmlspecialchars($_POST["customerName"]);
	$EMAIL = htmlspecialchars($_POST["customerEmail"]);
	$BODY = htmlspecialchars($_POST["customerMessage"]);
	
	if(!empty($NAME) && !empty($EMAIL) && !empty($BODY)){
		//echo 'All data exists\n';
		//Create a new PHPMailer instance
		$mail = new PHPMailer;
		//Tell PHPMailer to use SMTP
		$mail->isSMTP();
		//Enable SMTP debugging
		// 0 = off (for production use)
		// 1 = client messages
		// 2 = client and server messages
		$mail->SMTPDebug = 0;
		//Ask for HTML-friendly debug output
		$mail->Debugoutput = 'html';
		//Set the hostname of the mail server
		$mail->Host = 'server233.web-hosting.com';
		// use
		//$mail->Host = gethostbyname('mail.privateemail.com');
		// if your network does not support SMTP over IPv6
		//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
		$mail->Port = 465;
		//Set the encryption system to use - ssl (deprecated) or tls
		$mail->SMTPSecure = 'ssl';
		//Whether to use SMTP authentication
		$mail->SMTPAuth = true;
		//Username to use for SMTP authentication - use full email address for gmail
		$mail->Username = "inquiries@majesticsteamers.com";
		//Password to use for SMTP authentication
		$mail->Password = "#Wcv{(zSmTyp";
		//Set who the message is to be sent from
		$mail->setFrom('inquiries@majesticsteamers.com', 'Contact Form Submission');
		//Set who the message is to be sent to
		$mail->addAddress('inquiries@majesticsteamers.com', $EMAIL);
		//Set the subject line
		$mail->Subject = 'Inquiry from ' . $NAME;
		$mail->Body = 'From: ' . $NAME . '<br />E-mail: ' . $EMAIL . '<br /><br />Message:<br />' . $BODY;
		//Replace the plain text body with one created manually
		$mail->AltBody = $BODY;

		//send the message, check for errors
		if (!$mail->send()) {
		    //echo "Mailer Error: " . $mail->ErrorInfo;
		} else {
		    //echo "Message sent!";
		    
		}
		
	}
	header("Location:index.php");
}
?>

<html>

<head>
    <title>Majestic Steamer | Premium Carpet Cleaning Services</title>
    <link rel="stylesheet" href="main.css" />
    <link href="https://fonts.googleapis.com/css?family=Cinzel:900|Exo+2" rel="stylesheet" />
    <script type="text/javascript" src="main.js"></script>
</head>

<body onload="addListeners()" >
    <div id="Home"></div>
    <div class="navbar">
        <div id="logo">
            <img src="assets/imgs/logo.png" />
            <div id="namesection">
                <div id="name">Majestic<br/>Steamer</div>
                <div class="motto">Carpet Cleaning done right!</div>
            </div>
        </div>
    
        <div id="navselector"></div>
        <ul class="navlist">
            <a><li>Home</li></a>
            <a><li>Services</li></a>
            <a><li>Contact</li></a>
            <!--<a><li>Deals</li></a> !-->
        </ul>
        <div id="contactInfo">Call Now!<br/>(317)702-5236</div>
    </div>

    <div class="slideshow">
        <div class="slide" style="background-image: url('assets/imgs/Slideshow_1.jpg');"></div>
        <div class="slide" style="background-image: url('assets/imgs/Slideshow_2.jpg');"></div>
        <div class="slide" style="background-image: url('assets/imgs/Slideshow_3.jpg');"></div>
    </div>

    <div class="container">
        <div class="section-header">
            <div class="section-name dark">Our Services</div>
            <div class="section-message dark">We offer the following services <span style="font-style:italic">and more</span>! Call now and see what we have to offer!</div>
            <div class="breaker dark"></div>
        </div>
        <div class="services" id="Services">
            
            <div class="service">
                <img src="assets/imgs/services_cleaning.png" />
                <h1>Cleaning</h1>
                <div class="breaker"></div>
                <p>
                    We provide carpet cleaning for even the messiest situations! 
                    Call and ask how we can help you!
                </p>
            </div>
            
            
            <div class="service">
                <img src="assets/imgs/services_repair.png" />
                <h1>Repair</h1>
                <div class="breaker"></div>
                <p>
                    Carpets wear and tear as they get old. We have the tools and experience to restore it like new!
                </p>
            </div>
            
            
            <div class="service">
                <img src="assets/imgs/services_stains.png" />
                <h1>Stain Removal</h1>
                <div class="breaker"></div>
                <p>
                    Kids will be kids and we understand that. Here at Majestic Steamer, we pride ourselves on catering to our customers' needs, including stain & blot removal!
                </p>
            </div>
            
            <div class="service">
                <img src="assets/imgs/services_enzyme.png" />
                <h1>Enzyme Treatment</h1>
                <div class="breaker"></div>
                <p>
                    Smelly carpet? Strange odor in the house? It's probably coming from your carpet! We'll take care of it <span style="font-style:italic">and</span> make sure it doesn't come back!
                </p>
            </div>
        </div>

        <div id="Contact">
            <div class="section-header">
                <div class="section-name">Contact Us</div>
                <div class="section-message">Want to get a Quote? Questions? Comments?  We would love to hear from you!</div>
                <div class="breaker"></div>
                <form id="contactForm" method="POST">
                    <input type="text" placeholder="Name" name="customerName" required></input>
                    <input type="email" placeholder="E-Mail" name="customerEmail" required></input>
                    <textarea rows="4" cols="50" form="contactForm" maxlength="500" placeholder="Enter message here" name="customerMessage" required></textarea>
                    <button type="submit">Submit</button>
                </form>
            </div>
            
        </div>
        
    </div>



    <script>
        var slides = document.querySelectorAll('.slide');
        var currentSlide = 0;
        var oldSlide = null;

        document.onload = onload();
        function onload(){
            slides = document.querySelectorAll('.slide');
            slides[0].classList.add('active');
            setInterval(updateCurrentSlide, 8000); // repeats every 12 seconds
        }

        function updateCurrentSlide(){
            const oldSlide = (currentSlide-1) >= 0 ? currentSlide-1 : slides.length-1;
            const newSlide = (currentSlide+1) < slides.length ? currentSlide+1 : 0;

            // Move current slide off screen
            slides[currentSlide].classList.remove('active');
            slides[currentSlide].classList.add('old');

            // Show new slide
            slides[newSlide].classList.add('active');

            // Put "old" slide back in line to be shown again
            slides[currentSlide].addEventListener('transitionend', function(e){
                slides[oldSlide].classList.remove('old');
                e.target.removeEventListener(e.type, arguments.callee); // makes event fire only once!
            });

            currentSlide = newSlide;
            
        }
        function updateSlideshow(){

            
        }
    </script>
</body>

<footer>
</footer>

</html>